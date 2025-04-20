<?php

namespace app\core;

require_once __DIR__ . '/../controllers/StreamingController.php';

use app\controllers\MainController;
use app\controllers\UserController;
use app\controllers\MovieController;
use app\controllers\StreamingController;

class Router {
    public $uriArray;

    function __construct() {
        $this->uriArray = $this->routeSplit();
        $this->handleMainRoutes();
        $this->handleUserRoutes();
        $this->handleMovieRoutes();
    }

    protected function routeSplit() {
        $removeQueryParams = strtok($_SERVER["REQUEST_URI"], '?');
        return explode("/", $removeQueryParams);
    }

    protected function handleMainRoutes() {
        if ($this->uriArray[1] === '' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController = new MainController();
            $mainController->homepage();
        }
    }

    protected function handleMovieRoutes() {

        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'movies') {
            $streamingController = new StreamingController();
    
            if (isset($this->uriArray[3])) {
                if ($this->uriArray[3] === 'search' && isset($this->uriArray[4])) {
                    $query = urldecode($this->uriArray[4]);
                    $streamingController->searchMovies($query);
                } else {
                    //Handle other subroutes like top10, popular, etc.
                    http_response_code(404);
                    echo json_encode(['error' => 'Invalid route']);
                }
            } 
            else {
                //Home page fetch hits this
                $streamingController->getMovies();
            }
        }
    }

    protected function handleGenreRoutes() {
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'genres') {
            $streamingController = new StreamingController();
            $streamingController->getGenres();
        }
    }

    protected function handleUserRoutes() {
        $userController = new UserController();

        /*

        if ($this->uriArray[1] === 'user' && isset($this->uriArray[2]) && $this->uriArray[2] === 'signup' && isset($this->uriArray[3]) && $this->uriArray[3] === 'complete' && isset($this->uriArray[4]) && $this->uriArray[4] === 'finish-setup' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController->continueSetup();
        }
        */

        //setup complete
        if ($this->uriArray[1] === 'user' && isset($this->uriArray[2]) && $this->uriArray[2] === 'signup' && isset($this->uriArray[3]) && $this->uriArray[3] === 'complete' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController->SetupComplete();
        }
        
        // View: signup page
        if ($this->uriArray[1] === 'user' && isset($this->uriArray[2]) && $this->uriArray[2] === 'signup' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController->userSetUpView();
        }


    
        // View: all users page (html)
        if ($this->uriArray[1] === 'users' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController->usersView();
        }

        // View: login page (html)
        if ($this->uriArray[1] === 'login' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController->loginView();
        }

        // API: get all users
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'users' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController->getUsers();
        }
    
        // API: signup
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'signup' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->signup();
        }
    
        // API: login
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->login();
        }
    
        // API: logout
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'logout' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->logout();
        }

        // API: check session
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'session' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController->sessionStatus();
        }

        // API: get profile pictures
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'avatars' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController->getProfilePictures();
        }

        
    }
}