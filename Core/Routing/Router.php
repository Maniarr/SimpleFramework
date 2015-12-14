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
  private 	$routes;
  private   $url_404;

  function 	__construct()
  {
    $this->routes = array();
  }

  function	add_route($url, $function)
  {
    $route = new Route($url, $function);
    array_push($this->routes, $route);
  }

  function  add_404($function) {
      $this->url_404 = new Route('404 error', $function);
  }

  function	run()
  {
     if (BASE_URL != null)
        $url = str_replace(BASE_URL, '', $_SERVER['REQUEST_URI']);
     else
        $url = $_SERVER['REQUEST_URI'];

     foreach($this->routes as $route)
     {
        if ($route->equal_url($url)) {
    	    $route->call($url);
            return;
        }
     }
     if ($this->url_404 !== null)
        $this->url_404->call('404 error');
   }
}
