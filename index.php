<?php

require_once('Core'.DIRECTORY_SEPARATOR.'config.php');
require_once('Core'.DS.'Autoloader.php');

Autoloader::register();

use Core\Routing\Router;

$router = new Router();

$router->get('/', 'PageController::index');
$router->add_404('PageController::index');

$router->run();
