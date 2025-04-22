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

        $name = htmlspecialchars($data['name'], ENT_QUOTES);
        $content = htmlspecialchars($data['content'], ENT_QUOTES);

        $reviewModel = new Review();
        $reviewModel->add($name, $content);

        http_response_code(201);
        echo json_encode(['message' => 'Review added']);
    }
}