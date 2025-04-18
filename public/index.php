<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../app/core/setup.php';

use app\core\Router;

$router = new Router();