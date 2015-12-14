<?php

namespace Core\Config;

trait 	Autoload
{
  function load($load)
  {
    foreach($load as $key => $value)
    {
      $path = str_replace('\\', DIRECTORY_SEPARATOR, $value);
      require_once($path.'.php');
    }
  }
}
