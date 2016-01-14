<?php

class Controller
{
  function model($name)
  {
    $model_class = new ReflectionClass($name);
    $model = $model_class->newInstanceArgs(array($name));

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
