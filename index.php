<?php

require ("Router.php");

$router = new Router();

$router->add_route("/hello/{name}", "Test::hello"); 

$router->call($argv[1]);