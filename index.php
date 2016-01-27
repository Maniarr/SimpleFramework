<?php

require_once('Core'.DIRECTORY_SEPARATOR.'config.php');
require_once('Core'.DIRECTORY_SEPARATOR.'autoload.php');

use Core\Config\Autoload;

Autoload::load($load);

$router = new Router();

$router->get('/home2', 'PageController::index');

/* Ajax */
$router->post('/connect', 'MemberController::connect');
$router->post('/chatroom', 'MemberController::get_chat_room');
$router->post('/send', 'MessageController::send');
$router->post('/notif','MessageController::get_notif');

$router->post('/chatroom/name', 'MemberController::get_chat_name');
$router->post('/contact/add', 'MemberController::add_contact');
$router->post('/message/last', 'MessageController::get_last_message');
$router->post('/message/new','MessageController::get_new_message');

$router->add_404('PageController::route_404');

$router->run();
