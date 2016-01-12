<?php

class View
{
  public $path;
  public $data;

  function View($name)
  {
      $this->path = BASE_PATH.'View'.DIRECTORY_SEPARATOR.$name.'.php';
  }

  function render($data = array())
  {
    echo $this->fetch($data);
  }

  function fetch($data_controller = null)
  {
    if ($data_controller != null)
      $this->data = $data_controller;
      
    ob_start();
        require($this->path);
    return ob_get_clean();
  }

  function url($url) {
    echo URL.''.$url;
  }

  function asset($url) {
    echo URL.'public/'.$url;
  }
}
