<?php

namespace app\controllers;

use app\core\Controller;
use app\services\StreamingServiceApi;

class StreamingController extends Controller {
    public function getMovies() {
        $title = $_GET['title'] ?? null;
        $country = $_GET['country'] ?? 'us';
    
        $service = new StreamingServiceApi();
    
        //0nly pass title if actually searching
        if ($title && trim($title) !== '') {
            $movies = $service->getMovies($title, $country);
        } else {
            $movies = $service->getMovies(null, $country); //default categories
        }
    
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
