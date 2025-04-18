<?php

namespace app\services;

class StreamingServiceApi {
    private $apiKey;

    public function __construct() {
        $this->apiKey = 'a510d81c18msha0252262d20951fp129c91jsn6acb9fed9921';
    }

    public function getMovies($title = null, $country = 'us') {
        if ($title) {
            return $this->searchMoviesByTitle($title, $country);
        }

        return [
            'trending' => $this->searchMovies($country, [
                'order_by' => 'popularity_1week',
                'rating_min' => 60
            ]),
            'topRated' => $this->searchMovies($country, [
                'order_by' => 'rating',
                'year_min' => '2025',
                'order_direction' => 'desc'
            ]),
            'recent' => $this->searchMovies($country, [
                'order_by' => 'release_date',
                'year_min' => '2025',
                'order_direction' => 'desc'
            ]),
            'action' => $this->searchMovies($country, [
                'genres' => 'action',
                'order_by' => 'popularity_1month',
                'rating_min' => 65
            ])
        ];
    }

    public function getTVShows($title = null, $country = 'us') {
        if ($title) {
            return $this->searchTVShowsByTitle($title, $country);
        }

        return [
            'trending' => $this->searchTVShows($country, [
                'order_by' => 'popularity_1month',
                'order_direction' => 'desc',
                'series_granularity' => 'show'
            ]),
            'topRated' => $this->searchTVShows($country, [
                'order_by' => 'rating',
                'year_min' => '2024',
                'year_max' => '2025',
                'order_direction' => 'desc',
                'series_granularity' => 'show'
            ]),
            'recent' => $this->searchTVShows($country, [
                'order_by' => 'release_date',
                'year_min' => '2025',
                'order_direction' => 'desc',
                'series_granularity' => 'show'
            ]),
            'action' => $this->searchTVShows($country, [
                'genres' => 'action',
                'order_by' => 'popularity_1month',
                'rating_min' => 65,
                'series_granularity' => 'show'
            ])
        ];
    }

    private function searchMoviesByTitle($title, $country) {
        $url = "https://streaming-availability.p.rapidapi.com/shows/search/title?title=" . urlencode($title) . "&country={$country}&show_type=movie";
        return $this->makeRequest($url)['shows'] ?? [];
    }

    private function searchMovies($country = 'us', $filters = []) {
        $url = "https://streaming-availability.p.rapidapi.com/shows/search/filters?country={$country}&show_type=movie";
        $queryParams = [];

        foreach ($filters as $key => $value) {
            $queryParams[] = "$key=" . urlencode($value);
        }

        if (!empty($queryParams)) {
            $url .= '&' . implode('&', $queryParams);
        }

        return $this->makeRequest($url)['shows'] ?? [];
    }

    private function searchTVShowsByTitle($title, $country) {
        $url = "https://streaming-availability.p.rapidapi.com/shows/search/title?title=" . urlencode($title) . "&country={$country}&show_type=series";
        return $this->makeRequest($url)['shows'] ?? [];
    }

    private function searchTVShows($country = 'us', $filters = []) {
        $url = "https://streaming-availability.p.rapidapi.com/shows/search/filters?country={$country}&show_type=series";
        $queryParams = [];

        foreach ($filters as $key => $value) {
            $queryParams[] = "$key=" . urlencode($value);
        }

        if (!empty($queryParams)) {
            $url .= '&' . implode('&', $queryParams);
        }

        return $this->makeRequest($url)['shows'] ?? [];
    }

    private function makeRequest($url) {
        file_put_contents(__DIR__ . '/../../logs/last_tv_or_movie_request.txt', $url);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: streaming-availability.p.rapidapi.com",
                "x-rapidapi-key: " . $this->apiKey,
                "Accept: application/json"
            ]
        ]);

        $response = curl_exec($curl);
        file_put_contents(__DIR__ . '/../../logs/last_api_response.json', $response);
        curl_close($curl);

        $data = json_decode($response, true);

        if (isset($data['shows'])) {
            $pdo = $this->getDatabase();

            foreach ($data['shows'] as &$movie) {
                $img = $movie['imageSet']['verticalPoster']['w240'] ?? '';
                $isPlaceholder = str_contains($img, 'image.svg');

                if ($isPlaceholder && isset($movie['tmdbId'])) {
                    $tmdbId = preg_replace('/^(movie|show|tv)\//', '', $movie['tmdbId']);
                    $type = str_contains($movie['tmdbId'], 'tv') ? 'tv' : 'movie';

                    $stmt = $pdo->prepare("SELECT poster_path FROM posters WHERE tmdb_id = ?");
                    $stmt->execute([$tmdbId]);
                    $cachedPath = $stmt->fetchColumn();

                    if ($cachedPath) {
                        $movie['fallbackPoster'] = "https://image.tmdb.org/t/p/w342{$cachedPath}";
                    } else {
                        $posterPath = $this->fetchTmdbPosterPath($tmdbId, $type);
                        if ($posterPath) {
                            $movie['fallbackPoster'] = "https://image.tmdb.org/t/p/w342{$posterPath}";
                            $insert = $pdo->prepare("INSERT INTO posters (tmdb_id, poster_path) VALUES (?, ?)");
                            $insert->execute([$tmdbId, $posterPath]);
                        }
                    }
                }
            }
        }

        return $data;
    }

    private function fetchTmdbPosterPath($tmdbId, $type = 'movie') {
        $apiKey = 'd49dbc5dee65813cc43a2389613cf7f3';
        $url = "https://api.themoviedb.org/3/{$type}/{$tmdbId}?api_key={$apiKey}";

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response, true);
        return $data['poster_path'] ?? null;
    }

    private function getDatabase() {
        return new \PDO('mysql:host=localhost;dbname=WatchThis', 'root', 'root');
    }
}