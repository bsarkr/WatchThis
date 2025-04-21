<?php

namespace app\core;

abstract class Controller {

    public function returnView($pathToView) {
        $fullPath = __DIR__ . '/../../public/' . $pathToView;
        if (file_exists($fullPath)) {
            require $fullPath;
            exit();
        } else {
            http_response_code(404);
            echo "View not found: " . htmlspecialchars($pathToView);
            exit();
        }
    }

    public function returnJSON($json) {
        header("Content-Type: application/json");
        echo json_encode($json);
        exit();
    }
}