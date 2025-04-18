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

    protected function handleUserRoutes() {
        if ($this->uriArray[1] === 'users' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController = new UserController();
            $userController->usersView();
        }

        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'users' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController = new UserController();
            $userController->getUsers();
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
}