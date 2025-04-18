<?php

namespace app\core;

use app\services\StreamingService;
use app\models\Movie;

class MovieController extends Controller {
    private $streamingService;

    public function __construct() {
        $this->streamingService = new StreamingService();
    }

    public function getMovieById($type, $id) {
        $movieData = $this->streamingService->fetchMovieById($type, $id);

        if ($movieData) {
            $movie = new Movie($movieData);
            $this->returnJSON($movie);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Movie not found"]);
        }
    }

    public function getMovies() {
        $title = $_GET['title'] ?? 'batman';
        $moviesData = $this->streamingService->getMovies($title);
    
        echo "<pre>";
        print_r($moviesData);
        echo "</pre>";
        exit();
    }

    public function getPopularMovies() {
        $moviesData = $this->streamingService->getMovies("popular");
        header('Content-Type: application/json');
        echo json_encode($moviesData);
        exit();
    }
    
    // getting movies by genre
    public function getMoviesByGenre($genre, $country = 'us') {
        $endpoint = "/shows/search/filters";
        $params = [
            'country' => $country,
            'genres' => $genre,
            'show_type' => 'movie'
        ];
        return $this->makeApiRequest($endpoint, $params);
    }



    //getting top 10 movies
    public function getTop10Movies($country = 'us') {
        $endpoint = "/shows/top";
        $params = [
            'country' => $country,
            'show_type' => 'movie'
        ];
        return $this->makeApiRequest($endpoint, $params);
    }


    public function searchMovies($query) {
        $moviesData = $this->streamingService->getMovies($query);
    
        if (!is_array($moviesData)) {
            http_response_code(500);
            echo json_encode(["error" => "Invalid data returned from API"]);
            return;
        }
    
        header('Content-Type: application/json');
        echo json_encode($moviesData);
        exit();
    }
    
}