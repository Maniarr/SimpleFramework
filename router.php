<?php

function      __autoload($class)
{
  require_once($class.'.php');
}

class Router
{

  public 	$routes;

  function 	__construct()
  {
    $this->routes = array();
  }

  function	add_route($url, $function)
  {
    $route = new Route($url, $function);
    array_push($this->routes, $route);
  }

  function	call($url)
  {
    foreach($this->routes as $route)
    {
      if ($route->equal_url($url))
	$route->call($url);
    }
  }
}