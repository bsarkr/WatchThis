<?php

namespace app\controllers;

require_once __DIR__ . '/../core/Controller.php'; 

use app\core\Controller;


class MainController extends Controller {

    public function homepage() {
        $this->returnView('./assets/views/main/homepage.html');
    }

    public function notFound() {
    }

}