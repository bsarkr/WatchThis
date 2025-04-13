<?php

//require our files, remember should be relative to index.php

//Load base model first, then user model
require_once __DIR__ . '/../models/Model.php';
require_once __DIR__ . '/../models/User.php';

//Controller, router, and others
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/Router.php';
require_once __DIR__ . '/../controllers/MainController.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/MovieController.php';
require_once __DIR__ . '/../services/StreamingServiceApi.php';

//set up env variables
$env = parse_ini_file('../.env');

define('DBNAME', $env['DBNAME']);
define('DBHOST', $env['DBHOST']);
define('DBUSER', $env['DBUSER']);
define('DBPASS', $env['DBPASS']);


/*
$model = new Model();

try{
    $model->createMoviesTable();
}catch(Exception $e){
    error_log("Error creating movies table: " . $e->getMessage());
    echo "Error creating movies table: " . $e->getMessage();
}

try{
    $availability = $model->getStreamingAvailability('movie', '12345');
    echo $availability;
}catch(Exception $e){
    error_log("Error getting streaming availability: " . $e->getMessage());
    echo "Error getting streaming availability: " . $e->getMessage();
}
*/