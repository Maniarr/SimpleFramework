<?php

require_once('Core'.DIRECTORY_SEPARATOR.'config.php');
require_once('Core'.DIRECTORY_SEPARATOR.'autoload.php');

use Core\Config\Autoload;

Autoload::load($load);

$router = new Router();

$router->get('/', 'PageController::index');

$router->add_404('PageController::route_404');

$router->run();
