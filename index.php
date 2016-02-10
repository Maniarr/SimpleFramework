<?php

require_once('Core'.DIRECTORY_SEPARATOR.'config.php');
require_once('Core'.DS.'Autoloader.php');

Autoloader::register();

use Core\Routing\Router;

$router = new Router();

$router->get('/home', 'PageController::index');
$router->add_404('PageController::error_404');

$router->run();
