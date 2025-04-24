<?php

namespace app\controllers;

require_once __DIR__ . '/../models/Review.php';

use app\core\Controller;
use app\models\Review;

class ReviewController extends Controller {

    public function getAllReviews() {
        $reviewModel = new Review();
        $reviews = $reviewModel->getAll();

        http_response_code(200);
        echo json_encode($reviews);
    }

    public function addReview() {

        error_log("REVIEW SUBMIT HIT");
    
        $data = json_decode(file_get_contents("php://input"), true);
    
        if (!$data || !isset($data['name']) || !isset($data['content'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing name or content']);
            return;
        }
    
        $name = trim($data['name']);
        $content = trim($data['content']);
    
        //name must be at least 2 characters
        if (strlen($name) < 2) {
            http_response_code(400);
            echo json_encode(['error' => 'Name must be at least 2 characters.']);
            return;
        }
    
        //content must be 50–500 characters
        if (strlen($content) < 50) {
            http_response_code(400);
            echo json_encode(['error' => 'Review must be at least 50 characters.']);
            return;
        }
    
        if (strlen($content) > 500) {
            http_response_code(400);
            echo json_encode(['error' => 'Review must be under 500 characters.']);
            return;
        }
    
        //escape content for HTML output safety
        $name = htmlspecialchars($name, ENT_QUOTES);
        $content = htmlspecialchars($content, ENT_QUOTES);
    
        $reviewModel = new Review();
        $reviewModel->add($name, $content);
    
        http_response_code(201);
        echo json_encode(['message' => 'Review added']);
    }
}