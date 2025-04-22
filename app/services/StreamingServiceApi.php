<?php

namespace app\services;

class StreamingServiceApi {
    private $apiKey;

    public function __construct() {
        $this->apiKey = $_ENV['STREAMING_API_KEY'];
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

    public function getOnlyMovies($title = null, $country = 'us') {
        if ($title) {
            return $this->searchMoviesByTitle($title, $country);
        }

        return [
            'nextWatch' => $this->searchMovies($country, [
                'order_by' => 'popularity_1month',
                'rating_min' => 50,
                'order_direction' => 'desc'
            ]),
            'popular' => $this->searchMovies($country, [
                'order_by' => 'popularity_1year',
                'rating_min' => 50,
                'order_direction' => 'desc'
            ]),
            'action' => $this->searchMovies($country, [
                'genres' => 'action',
                'order_by' => 'popularity_1month',
                'order_direction' => 'desc'
            ]),
            'drama' => $this->searchMovies($country, [
                'genres' => 'drama',
                'order_by' => 'popularity_1month',
                'order_direction' => 'desc'
            ]),
            'comedy' => $this->searchMovies($country, [
                'genres' => 'comedy',
                'order_by' => 'popularity_1month',
                'order_direction' => 'desc'
            ]),
            'thriller' => $this->searchMovies($country, [
                'genres' => 'thriller',
                'order_by' => 'popularity_1month',
                'order_direction' => 'desc'
            ]),
        ];
    }

    public function getMoviesByGenre($genre, $country = 'us') {
        if (!$genre) return [];
    
        $yearRanges = [
            ['min' => 2024, 'max' => 2025],
            ['min' => 2023, 'max' => 2024],
            ['min' => 2022, 'max' => 2023],
            ['min' => 2021, 'max' => 2022],
            ['min' => 2020, 'max' => 2021]
        ];
    
        $combined = [];
    
        foreach ($yearRanges as $range) {
            $results = $this->searchMovies($country, [
                'genres' => $genre,
                'year_min' => $range['min'],
                'year_max' => $range['max'],
                'order_by' => 'popularity_1year',
                'rating_min' => 50,
                'order_direction' => 'desc'
            ]);
            $combined = array_merge($combined, $results);
        }
    
        //remove duplicates based on title
        $seen = [];
        $unique = [];
        foreach ($combined as $movie) {
            $title = strtolower($movie['title'] ?? '');
            if ($title && !isset($seen[$title])) {
                $seen[$title] = true;
                $unique[] = $movie;
            }
        }
    
        return $this->applyFallbackImages($unique);
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

    public function getOnlyTVShows($title = null, $country = 'us') {
        if ($title) {
            return $this->searchTVShowsByTitle($title, $country);
        }

        return [
            'nextWatch' => $this->searchTVShows($country, [
                'order_by' => 'popularity_1month',
                'rating_min' => 50,
                'order_direction' => 'desc',
                'series_granularity' => 'show'
            ]),
            'popular' => $this->searchTVShows($country, [
                'order_by' => 'popularity_1year',
                'rating_min' => 50,
                'order_direction' => 'desc',
                'series_granularity' => 'show'
            ]),
            'action' => $this->searchTVShows($country, [
                'genres' => 'action',
                'order_by' => 'popularity_1month',
                'order_direction' => 'desc',
                'series_granularity' => 'show'
            ]),
            'drama' => $this->searchTVShows($country, [
                'genres' => 'drama',
                'order_by' => 'popularity_1month',
                'order_direction' => 'desc',
                'series_granularity' => 'show'
            ]),
            'comedy' => $this->searchTVShows($country, [
                'genres' => 'comedy',
                'order_by' => 'popularity_1month',
                'order_direction' => 'desc',
                'series_granularity' => 'show'
            ]),
            'thriller' => $this->searchTVShows($country, [
                'genres' => 'thriller',
                'order_by' => 'popularity_1month',
                'order_direction' => 'desc',
                'series_granularity' => 'show'
            ]),
        ];
    }

    public function getShowsByGenre($genre, $country = 'us') {
        if (!$genre) return [];
    
        // Valid genre keywords known to work with this API
        $validGenres = ['action', 'drama', 'comedy', 'thriller', 'romance', 'animation'];
        if (!in_array($genre, $validGenres)) return [];
    
        $yearRanges = [
            ['min' => 2024, 'max' => 2025],
            ['min' => 2023, 'max' => 2024],
            ['min' => 2022, 'max' => 2023],
            ['min' => 2021, 'max' => 2022],
            ['min' => 2020, 'max' => 2021]
        ];
    
        $combined = [];
    
        foreach ($yearRanges as $range) {
            $results = $this->searchTVShows($country, [
                'genres' => $genre,
                'year_min' => $range['min'],
                'year_max' => $range['max'],
                'order_by' => 'popularity_1year',
                'order_direction' => 'desc',
                'series_granularity' => 'show'
            ]);
    
            if (is_array($results)) {
                $combined = array_merge($combined, $results);
            }
        }
    
        // remove duplicates based on title
        $seen = [];
        $unique = [];
        foreach ($combined as $show) {
            $title = strtolower($show['title'] ?? '');
            if ($title && !isset($seen[$title])) {
                $seen[$title] = true;
                $unique[] = $show;
            }
        }
    
        return $this->applyFallbackImages($unique);
    }

    public function searchByKeyword($keyword) {
        $keyword = trim($keyword);
        if (!$keyword) return [];
    
        $movieResults = $this->searchByTitleType('movie', $keyword);
        $seriesResults = $this->searchByTitleType('series', $keyword);

        if (count($movieResults) === 0 && count($seriesResults) === 0) {
            $generalResults = $this->searchByTitleType(null, $keyword); // ⬅️ added fallback
            return $generalResults;
        }

        error_log("🔍 Searching keyword: $keyword");
    
        $combined = array_merge($movieResults, $seriesResults);
    
        //removing duplicates based on title
        $seen = [];
        $final = [];
        foreach ($combined as $item) {
            $title = strtolower($item['title'] ?? '');
            if ($title && !isset($seen[$title])) {
                $seen[$title] = true;
                $final[] = $item;
            }
        }
    
        return $this->applyFallbackImages($final); // adds fallback images
    }
    
    private function searchByTitleType($type, $title) {
        $params = [
            'title' => $title,
            'country' => 'us'
        ];
        if ($type) {
            $params['show_type'] = $type;
        }
    
        $url = "https://streaming-availability.p.rapidapi.com/shows/search/title?" . http_build_query($params);
        $response = $this->makeRequest($url);
    
        file_put_contents(__DIR__ . '/../../logs/last_search_title_request.txt', $url); //debugging
    
        if (isset($response[0])) return $response;
        return $response['shows'] ?? [];
    }

    private function searchMoviesByTitle($title, $country) {
        $url = "https://streaming-availability.p.rapidapi.com/shows/search/title?title=" . urlencode($title) .
               "&country={$country}&show_type=movie";
        return $this->makeRequest($url)['shows'] ?? [];
    }

    private function searchTVShowsByTitle($title, $country) {
        $url = "https://streaming-availability.p.rapidapi.com/shows/search/title?title=" . urlencode($title) .
               "&country={$country}&show_type=series";
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
        file_put_contents(__DIR__ . '/../../logs/debug_details_url.txt', $url);
    
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => str_starts_with($url, 'http') ? $url : "https://streaming-availability.p.rapidapi.com{$url}",
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
    
        if (isset($data[0])) {
            return ['shows' => $data];
        }
    
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
        $apiKey = $_ENV['TMDB_API_KEY'];
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

    private function applyFallbackImages(array $items): array {
        $pdo = $this->getDatabase();
    
        foreach ($items as &$movie) {
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

            if (!isset($movie['fallbackPoster']) || !$movie['fallbackPoster']) {
                $movie['fallbackPoster'] = 'https://via.placeholder.com/240x360?text=No+Poster';
            }
        }
    
        return $items;
    }

    public function getDetailsById($id, $type = 'movie') {
        $url = "/shows/{$id}?country=us";
        $response = $this->makeRequest($url);
    
        if (!$response || isset($response['error'])) return null;
    
        return [
            'id' => $response['imdbId'] ?? '',
            'itemType' => $response['itemType'] ?? '',
            'showType' => $response['showType'] ?? '',
            'tmdbId' => $response['tmdbId'] ?? '',
            'title' => $response['title'] ?? '',
            'originalTitle' => $response['originalTitle'] ?? '',
            'year' => $response['releaseYear'] ?? '',
            'type' => $type,
            'description' => $response['overview'] ?? '',
            'tagline' => $response['tagline'] ?? '',
            'poster' => $response['imageSet']['verticalPoster'] ?? null,
            'backdrops' => $response['imageSet']['verticalBackdrop'] ?? [],
            'imdb_rating' => $response['rating'] ?? '',
            'cast' => $response['cast'] ?? [],
            'director' => $response['directors'][0] ?? '',
            'creator' => $response['creator'] ?? '',
            'duration' => $response['runtime'] ?? '',
            'episodes' => $response['totalEpisodes'] ?? '',
            'seasons' => $response['seasons'] ?? '',
            'genres' => array_map(fn($g) => $g['name'], $response['genres'] ?? []),
            'country' => $response['country'] ?? '',
            'streamingPlatforms' => isset($response['streamingOptions']['us']) 
                ? array_map(fn($opt) => [
                    'name' => $opt['service']['name'] ?? '',
                    'link' => $opt['link'] ?? '',
                    'logo' => $opt['service']['imageSet']['whiteImage'] ?? '',
                    'type' => $opt['type'] ?? '', // rent / subscription / buy
                ], $response['streamingOptions']['us'])
                : [],
            'trailer' => [
                'youtubeVideoId' => $this->getTrailerFromTMDB($response['tmdbId'] ?? null)
            ]
        ];
    }

    public function getTrailerFromTMDB($tmdbId) {
        if (!$tmdbId) return null;
    
        $cleanId = preg_replace('/^(movie|tv|show)\//', '', $tmdbId);
        $type = str_contains($tmdbId, 'tv') ? 'tv' : 'movie';
    
        // ✅ Load the API key from environment
        $apiKey = $_ENV['TMDB_API_KEY'] ?? null;
        if (!$apiKey) return null;
    
        $url = "https://api.themoviedb.org/3/{$type}/{$cleanId}/videos?api_key={$apiKey}";
    
        $res = @file_get_contents($url); // suppress warning
        if ($res === false) return null;
    
        $json = json_decode($res, true);
        if (!isset($json['results']) || !is_array($json['results'])) return null;
    
        foreach ($json['results'] as $video) {
            if (
                strtolower($video['type']) === 'trailer' &&
                strtolower($video['site']) === 'youtube'
            ) {
                return $video['key'];
            }
        }
    
        return null;
    }
}