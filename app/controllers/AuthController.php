<?php

namespace app\controllers;

use app\core\Controller;
use app\core\AuthHelper;
use app\models\User;

class AuthController extends Controller {

    public function loginView() {
        AuthHelper::nonAuthRoute();
        $this->returnView('./assets/views/auth/login.html');
    }

    public function login() {
        $input = json_decode(file_get_contents("php://input"), true);
        $email = $input['email'] ?? false;
        $password = $input['password'] ?? false;
    
        $user = new User();
        $authedUser = $user->login([
            'email' => $email,
            'password' => $password
        ]);
    
        if (!$authedUser) {
            http_response_code(401);
            $this->returnJSON(['error' => 'Invalid credentials']);
            return;
        }
    
        AuthHelper::startSession($authedUser);
    
        http_response_code(200);
        $this->returnJSON(['route' => '/']);
    }

    public function logout() {
        AuthHelper::endSession();
        http_response_code(200);
        $this->returnJSON(['message' => 'Logged out']);
    }
}