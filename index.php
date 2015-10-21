<?php

require_once('Core'.DIRECTORY_SEPARATOR.'config.php');
require_once('Core'.DIRECTORY_SEPARATOR.'autoload.php');

use Core\Config\Autoload;

Autoload::load($load);

$router = new Router();

$router->add_route("/hello/{name}", "TestController::hello"); 

$router->call($argv[1]);