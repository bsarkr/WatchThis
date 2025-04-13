<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// ✅ Now load setup (e.g., autoloaders, env vars, db, etc.)
require_once __DIR__ . '/../app/core/setup.php';

use app\core\Router;

// ✅ Then initialize the router
$router = new Router();