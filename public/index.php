<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

use app\core\EnvLoader;
require_once __DIR__ . '/../app/core/EnvLoader.php';
EnvLoader::load();

require_once __DIR__ . '/../app/core/setup.php';

use app\core\Router;

$router = new Router();