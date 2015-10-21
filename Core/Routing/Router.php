<?php

function	 __autoload($class)
{
  if (strpos($class, 'Controller') == -1)
    require_once($class.'.php');
  else
    require_once(realpath('Controller'.DIRECTORY_SEPARATOR.$class.'.php'));
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