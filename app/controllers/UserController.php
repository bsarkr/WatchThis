<?php

namespace app\controllers;
use app\models\User;
use app\core\Controller;

class UserController extends Controller {
    public function getUsers() {
        $userModel = new User();
        $users = $userModel->getAllUsers();
        $this->returnJSON($users);
    }

    public function usersView() {
        $this->returnView('./assets/views/users/usersView.html');
    }

    public function userSetUpView() {
        $this->returnView('./assets/views/auth/userSetupView.html');
    }

    public function loginView() {
        $this->returnView('./assets/views/auth/loginView.html');
    }

    public function setupComplete() {
        $this->returnView('./assets/views/auth/setupComplete.html');
    }

    public function signup() {
        $input = json_decode(file_get_contents("php://input"), true);
        $username = trim($input['username'] ?? '');
        $email = trim($input['email'] ?? '');
        $password = $input['password'] ?? '';
        $avatarId = intval($input['avatar'] ?? 0);
    
        if (!$username || !$email || !$password || !$avatarId) {
            http_response_code(400);
            echo json_encode(['error' => 'All fields are required.']);
            return;
        }
    
        $userModel = new \app\models\User();
    
        if ($userModel->findByEmail($email)) {
            http_response_code(409);
            echo json_encode(['error' => 'Email already exists.']);
            return;
        }
    
        if ($userModel->findByUsername($username)) {
            http_response_code(409);
            echo json_encode(['error' => 'Username already taken.']);
            return;
        }
    
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $userModel->create($username, $email, $passwordHash, $avatarId);
    
        http_response_code(201);
        echo json_encode(['success' => true]);
    }

    public function login() {
        $input = json_decode(file_get_contents("php://input"), true);
        $email = trim($input['email'] ?? '');
        $password = $input['password'] ?? '';

        if (!$email || !$password) {
            http_response_code(400);
            echo json_encode(['error' => 'All fields are required.']);
            return;
        }

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            echo json_encode(['message' => 'Login successful.']);
        } else {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid credentials.']);
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        echo json_encode(['message' => 'Logged out successfully.']);
    }

    public function sessionStatus() {
        session_start();
        if (isset($_SESSION['user_id'])) {
            echo json_encode([
                'loggedIn' => true,
                'username' => $_SESSION['username']
            ]);
        } else {
            echo json_encode(['loggedIn' => false]);
        }
    }


    public function getProfilePictures() {
        $pdo = new \PDO('mysql:host=localhost;dbname=WatchThis', 'root', 'root');
        $stmt = $pdo->query("SELECT * FROM profile_pictures");
        $pictures = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        echo json_encode($pictures);
    }
}

