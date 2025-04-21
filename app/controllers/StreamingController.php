<?php

namespace app\controllers;

use app\core\Controller;
use app\services\StreamingServiceApi;

class StreamingController extends Controller {
    
    //fetches movies and TV shows
    public function getMovies() {
        $title = $_GET['title'] ?? null;
        $genre = $_GET['genre'] ?? null;
        $country = $_GET['country'] ?? 'us';
    
        $service = new StreamingServiceApi();
    
        //handles genre-based filtering 
        if ($genre) {
            $results = $service->getMoviesByGenre($genre, $country);
            header('Content-Type: application/json');
            echo json_encode(['movies' => $results]);
            return;
        }
    
        //title-based search
        if ($title && trim($title) !== '') {
            $movies = $service->getMovies($title, $country);
            $tv = $service->getTVShows($title, $country);
        } else {
            //homepage-style fetch
            $movies = $service->getMovies(null, $country);
            $tv = $service->getTVShows(null, $country);
        }
    
        header('Content-Type: application/json');
        echo json_encode([
            'movies' => $movies,
            'tv' => $tv
        ]);
    }

    //fetch a single movie or show by ID
    public function getMovieById($type, $id) {
        $service = new StreamingServiceApi();
        $movie = $service->getMovieById($type, $id);

        if ($movie) {
            $this->returnJSON($movie);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Movie not found"]);
        }
    }

    public function getOnlyMovies() {
        $api = new \app\services\StreamingServiceApi();
        $movies = $api->getOnlyMovies();
    
        header('Content-Type: application/json');
        echo json_encode(['movies' => $movies]);
    }

    public function getOnlyShows() {
        $api = new \app\services\StreamingServiceApi();
        $shows = $api->getOnlyTVShows();
    
        header('Content-Type: application/json');
        echo json_encode(['series' => $shows]);
    }

    public function getShows() {
        $genre = $_GET['genre'] ?? null;
        $country = $_GET['country'] ?? 'us';
    
        $service = new StreamingServiceApi();
    
        if ($genre) {
            $results = $service->getShowsByGenre($genre, $country);
            header('Content-Type: application/json');
            echo json_encode(['shows' => $results]);
            return;
        }
    
        $tv = $service->getTVShows(null, $country);
        header('Content-Type: application/json');
        echo json_encode(['tv' => $tv]);
    }

    public function searchByKeyword($keyword, $country = 'us') {
        $endpoint = "https://streaming-availability.p.rapidapi.com/search/filters";
      
        $params = [
          'country' => $country,
          'keyword' => $keyword,
          'order_by' => 'original_title',
          'order_direction' => 'desc',
          'genres_relation' => 'or',
          'series_granularity' => 'show',
          'output_language' => 'en'
        ];
      
        return $this->makeApiRequest($endpoint, $params);
    }
}