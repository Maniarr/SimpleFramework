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
  private   $routes_get = array();
  private 	$routes_post = array();
  private   $url_404;

  function	get($url, $function)
  {
    $route = new Route($url, $function);
    array_push($this->routes_get, $route);
  }

  function	post($url, $function)
  {
    $route = new Route($url, $function);
    array_push($this->routes_post, $route);
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
     $routes = null;
     if ($_SERVER['REQUEST_METHOD'] == 'GET')
        $routes = $this->routes_get;
     if ($_SERVER['REQUEST_METHOD'] == 'POST')
        $routes = $this->routes_post;

     if ($routes !== null) {
         foreach($routes as $route)
         {
            if ($route->equal_url($url)) {
        	    $route->call($url);
                return;
            }
         }
     }

     if ($this->url_404 !== null)
        $this->url_404->call('404 error');
   }
}
