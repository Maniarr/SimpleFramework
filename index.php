<?php

require_once('Core'.DIRECTORY_SEPARATOR.'config.php');
require_once('Core'.DIRECTORY_SEPARATOR.'autoload.php');

use Core\Config\Autoload;

Autoload::load($load);

$router = new Router();

$router->add_route("/{name}", "TestController::hello"); 
$router->add_route("/info/{str}", "TestController::info");

$router->call($argv[1]);