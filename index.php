<?php

require_once('Core'.DIRECTORY_SEPARATOR.'config.php');
require_once('Core'.DIRECTORY_SEPARATOR.'autoload.php');

use Core\Config\Autoload;

Autoload::load($load);

$router = new Router();

$router->get("/{name}", "TestController::hello");
$router->get("/info/{str}", "TestController::info");

$router->run();
