<?php

//Start session
session_start();

$env = parse_ini_file('../.env');
define('DBNAME', $env['DBNAME']);
define('DBHOST', $env['DBHOST']);
define('DBUSER', $env['DBUSER']);
define('DBPASS', $env['DBPASS']);

require_once __DIR__ . '/../models/Model.php';
require_once __DIR__ . '/../models/User.php';

require_once __DIR__ . '/AuthHelper.php';
use \app\core\AuthHelper;
AuthHelper::checkSession();

require_once __DIR__ . '/../core/Database.php';

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/Router.php';

require_once __DIR__ . '/../controllers/MainController.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/MovieController.php';

require_once __DIR__ . '/../services/StreamingServiceApi.php';