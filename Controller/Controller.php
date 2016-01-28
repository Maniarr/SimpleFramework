<?php

namespace Controller;

use Core\View;

class Controller
{
  function model($name)
  {
    $class = '\Model\\'.$name;
    $model = new $class($name);
    
    return ($model);
  }

  function view($name, $data = null)
  {
    $v = new View($name);
    $v->render($data);
  }

  function redirect($url) {
    if ($url == '/')
      $url = null;

    $url_redirect = URL.''.$url;

    header("Location: $url_redirect");
    return;
  }
}
