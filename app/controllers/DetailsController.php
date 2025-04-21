<?php

namespace app\controllers;

use app\core\Controller;
use app\services\StreamingServiceApi;

class DetailsController extends Controller {
    public function detailsView($type, $id) {
        $this->returnView('/assets/views/main/details.html');
    }

    public function apiShow($type, $id) {
        $service = new StreamingServiceApi();
        $data = $service->getDetailsById($id, $type);
        $this->returnJSON($data);
    }
}
