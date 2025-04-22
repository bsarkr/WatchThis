<?php

namespace app\controllers;

require_once __DIR__ . '/../core/Controller.php'; 
require_once __DIR__ . '/../core/AuthHelper.php'; 

use app\core\Controller;
use app\core\AuthHelper;

class MainController extends Controller {
    public function homepage() {
        $this->returnView('./assets/views/main/homepage.html');
    }

    public function moviesView() {
        $this->returnView('./assets/views/main/movies.html');
    }

    public function showsView() {
        $this->returnView('./assets/views/main/shows.html');
    }

    public function reviewView() {
        $this->returnView('./assets/views/main/review.html');
    }

    public function notFound() {}

    public function appData() {



        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        error_log('appData route hit');
        error_log('Session ID: ' . session_id());
        error_log('Session Contents: ' . json_encode($_SESSION));
    
        \app\core\AuthHelper::checkSession();
    
        if (isset($_SESSION['id'])) {
            $userModel = new \app\models\User();
            $user = $userModel->getUserByID($_SESSION['id']);
    
            http_response_code(200);
            $this->returnJSON([
                'currentUser' => [
                    'username' => $user['username'] ?? '',
                    'email' => $user['email'] ?? ''
                ]
            ]);
        } else {
            http_response_code(401);
            $this->returnJSON(['error' => 'Unauthorized']);
        }
    }
}