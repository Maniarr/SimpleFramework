<?php

class View
{
  public $path;

  function View($name)
  {
    $this->path = BASE_PATH."View/".$name.".php";
  }

  function render($data = null)
  {
    echo $this->fetch($data);
  }

  function fetch($data)
  {
    ob_start();
    require($this->path);
    return ob_get_clean();
  }
}
