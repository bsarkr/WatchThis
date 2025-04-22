<?php

namespace app\core;

require_once __DIR__ . '/../controllers/StreamingController.php';
require_once __DIR__ . '/../controllers/SearchController.php';
require_once __DIR__ . '/../controllers/DetailsController.php';
require_once __DIR__ . '/../controllers/ReviewController.php';

use app\controllers\MainController;
use app\controllers\UserController;
use app\controllers\MovieController;
use app\controllers\StreamingController;
use app\controllers\AuthController;
use app\controllers\SearchController;
use app\controllers\DetailsController;
use app\controllers\ReviewController;

class Router {
    public $uriArray;

    function __construct() {
        $this->uriArray = $this->routeSplit();
        $this->handleMainRoutes();
        $this->handleUserRoutes();
        $this->handleMovieRoutes();
        $this->handleGenreRoutes();
        $this->handleDetailsRoutes();
        $this->handleReviewRoutes(); 
    }

    protected function routeSplit() {
        $removeQueryParams = strtok($_SERVER["REQUEST_URI"], '?');
        return explode("/", $removeQueryParams);
    }

    // Main Views
    protected function handleMainRoutes() {
        if ($this->uriArray[1] === '' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController = new MainController();
            $mainController->homepage();
        }

        if ($this->uriArray[1] === 'movies' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController = new MainController();
            $mainController->moviesView();
        }

        if ($this->uriArray[1] === 'shows' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController = new MainController();
            $mainController->showsView();
        }

        if ($this->uriArray[1] === 'review' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController = new MainController();
            $mainController->reviewView();
        }
    }

    // Movies + Streaming Data
    protected function handleMovieRoutes() {
        $streamingController = new StreamingController();

        // Main /api/movies logic
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'movies') {
            if (isset($this->uriArray[3])) {
                if ($this->uriArray[3] === 'search' && isset($this->uriArray[4])) {
                    $query = urldecode($this->uriArray[4]);
                    $streamingController->searchMovies($query);
                } else {
                    http_response_code(404);
                    echo json_encode(['error' => 'Invalid route']);
                }
            } else {
                $streamingController->getMovies();
            }
        }

        // movie-only homepage logic
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'only-movies') {
            $streamingController->getOnlyMovies();
        }

        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'only-shows') {
            $streamingController->getOnlyShows();
        }

        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'search') {
            $searchController = new SearchController();
            $searchController->search();
        }
    }

    // Genres 
    protected function handleGenreRoutes() {
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'genres') {
            $streamingController = new StreamingController();
            $streamingController->getGenres();
        }
    }

    // Details Routes 
    protected function handleDetailsRoutes() {
        $detailsController = new DetailsController();
    
        if ($this->uriArray[1] === 'details' && isset($this->uriArray[2]) && isset($this->uriArray[3]) && $_SERVER['REQUEST_METHOD'] === 'GET') {

            $type = $this->uriArray[2];   // movie or series
            $id = $this->uriArray[3];     // IMDB id

            $detailsController->detailsView($type, $id);
        }

        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'details' && isset($this->uriArray[3]) && isset($this->uriArray[4]) && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $type = $this->uriArray[3];
            $id = $this->uriArray[4];
            $detailsController->apiShow($type, $id);
        }
    }

    protected function handleReviewRoutes() {
        $reviewController = new ReviewController();
    
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'reviews') {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $reviewController->getAllReviews();
            } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $reviewController->addReview();
            }
        }
    }

    // User & Auth Routes 
    protected function handleUserRoutes() {
        $userController = new UserController();

        // TEMP: session debug
        if ($this->uriArray[1] === 'session-test') {
            echo json_encode($_SESSION);
            exit;
        }

        // View: signup complete
        if ($this->uriArray[1] === 'user' && isset($this->uriArray[2]) && $this->uriArray[2] === 'signup' && isset($this->uriArray[3]) && $this->uriArray[3] === 'complete' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController->SetupComplete();
        }

        // View: signup form
        if ($this->uriArray[1] === 'user' && isset($this->uriArray[2]) && $this->uriArray[2] === 'signup' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController->userSetUpView();
        }

        // API: signup
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'signup' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->signup();
        }

        // View: all users
        if ($this->uriArray[1] === 'users' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController->usersView();
        }

        // API: all users
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'users' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController->getUsers();
        }

        // View: login form
        if ($this->uriArray[1] === 'login' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController->loginView();
        }

        // API: login
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController = new AuthController();
            $authController->login();
        }

        // API: logout
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'logout' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->logout();
        }

        // API: session check
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'session' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController->sessionStatus();
        }

        // API: get avatars
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'avatars' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController->getProfilePictures();
        }
    }
}