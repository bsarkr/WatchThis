<?php

namespace app\controllers;

use app\core\Controller;
use app\services\StreamingServiceApi;

class DetailsController extends Controller {
    public function detailsView($type, $id) {
        $this->returnView('/assets/views/main/details.html');
    }

    public function apiShow($type, $id) {
        //prevent PHP warnings from leaking into JSON
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);
        error_reporting(0);
    
        $service = new StreamingServiceApi();
        $data = $service->getDetailsById($id, $type);
        
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
