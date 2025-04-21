<?php

namespace app\controllers;

use app\core\Controller;
use app\services\StreamingServiceApi;

class DetailsController extends Controller {

    public function show($type, $id) {
        $api = new StreamingServiceApi();

        $data = $api->getDetailsById($id, $type);

        if (!$data) {
            http_response_code(404);
            echo json_encode(['error' => 'Details not found']);
            return;
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }
}