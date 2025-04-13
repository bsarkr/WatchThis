<?php

namespace app\controllers;

use app\core\Controller;
use app\services\StreamingServiceApi;

class StreamingController extends Controller {
    public function getMovies() {
        $title = $_GET['title'] ?? 'batman'; // fallback title
        $country = $_GET['country'] ?? 'us'; // fallback country
    
        $service = new StreamingServiceApi();
        $movies = $service->getMovies($title, $country);
    
        header('Content-Type: application/json');
        echo json_encode($movies);
    }

    //getting movie by id
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
