<?php

namespace app\controllers;

use app\core\Controller;
use app\services\StreamingServiceApi;

class StreamingController extends Controller {
    
    // Fetches movies and TV shows
    public function getMovies() {
        $title = $_GET['title'] ?? null;
        $country = $_GET['country'] ?? 'us';

        $service = new StreamingServiceApi();

        // If searching by title
        if ($title && trim($title) !== '') {
            $movies = $service->getMovies($title, $country);
            $tv = $service->getTVShows($title, $country);
        } else {
            // Load default categories
            $movies = $service->getMovies(null, $country);
            $tv = $service->getTVShows(null, $country);
        }

        header('Content-Type: application/json');
        echo json_encode([
            'movies' => $movies,
            'tv' => $tv
        ]);
    }

    // Fetch a single movie or show by ID
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
}