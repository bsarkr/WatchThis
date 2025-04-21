<?php

namespace app\controllers;

use app\core\Controller;
use app\services\StreamingServiceApi;

class SearchController extends Controller {

    public function search() {
        $keyword = $_GET['keyword'] ?? '';
        if (!$keyword) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing keyword']);
            return;
        }

        $api = new StreamingServiceApi();
        $results = $api->searchByKeyword($keyword); 

        error_log("SearchController received: " . $_GET['keyword']);

        header('Content-Type: application/json');
        echo json_encode($results);
    }
}