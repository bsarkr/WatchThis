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
        $title = $_GET['title'] ?? null;
    
        // Movies and TV show data
        $movies = $this->streamingService->getMovies($title);
        $tvShows = $this->streamingService->getTVShows();
    
        // Return both
        header('Content-Type: application/json');
        echo json_encode([
            'trending' => $movies['trending'] ?? [],
            'topRated' => $movies['topRated'] ?? [],
            'recent' => $movies['recent'] ?? [],
            'action' => $movies['action'] ?? [],
            'tv' => [
                'trending' => $tvShows['trending'] ?? [],
                'topRated' => $tvShows['topRated'] ?? [],
                'recent' => $tvShows['recent'] ?? [],
                'action' => $tvShows['action'] ?? []
            ]
        ]);
        exit();
    }


    public function searchMovies($query) {
        $movies = $this->streamingService->getMovies($query);
        $tvShows = $this->streamingService->getTVShows($query);
    
        if (!is_array($movies) || !is_array($tvShows)) {
            http_response_code(500);
            echo json_encode(["error" => "Invalid data returned from API"]);
            return;
        }
    
        header('Content-Type: application/json');
        echo json_encode([
            'movies' => $movies,
            'tv' => $tvShows
        ]);
        exit();
    }
    
}