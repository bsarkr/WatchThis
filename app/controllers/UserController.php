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
    
        // Username: letters, numbers, underscores only
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            http_response_code(400);
            echo json_encode(['error' => 'Username can only contain letters, numbers, and underscores.']);
            return;
        }
    
        // Password: at least 8 characters
        if (strlen($password) < 8) {
            http_response_code(400);
            echo json_encode(['error' => 'Password must be at least 8 characters long.']);
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
        $created = $userModel->create($username, $email, $passwordHash, $avatarId);

        if (!$created) {
            http_response_code(500);
            echo json_encode(['error' => 'Something went wrong. Please try again.']);
            return;
        }

        http_response_code(201);
        echo json_encode(['success' => true]);
    }

    public function sessionStatus() {
        if (isset($_SESSION['id'])) {
            echo json_encode([
                'loggedIn' => true,
                'email' => $_SESSION['email']
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