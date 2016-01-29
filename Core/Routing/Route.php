<?php

namespace Core\Routing;

class Route
{
  public 	    $url;
  protected  	$class;
  protected 	$method;

  function 	__construct($url, $function)
  {
    $tmp = explode('::', $function);
    $this->url = $url;
    $this->class = $tmp[0];
    $this->method = $tmp[1];
  }

  function	equal_url($url)
  {
    $url = explode('?', $url)[0];
    $original = explode('/', $this->url);
    
    if (strlen($url) > 1 && $url[strlen($url) - 1] === '/')
        $url = substr($url, 0, -1);
    $tmp = explode('/', $url);

    for ($i = 0; $i < count($original); $i++)
    { 
      if (isset($original[$i]) && isset($tmp[$i]))
      {

        if ('' === $original[1] && '' === $tmp[1] && count($original) == count($tmp))
          return (1);
        else
        {
          if (!preg_match('/^'.$original[$i].'$/', $tmp[$i])) 
            return (0); 
        }
      }
    }
    return (1);
  }

  function	get_params($url)
  {
    $response = array();
    $original = explode('/', $this->url);
    $tmp = explode('/', $url);

    for ($i = 0; $i < count($original); $i++)
    {
      if (preg_match('/^[(][^\/]+[)]$/', $original[$i]))
	       array_push($response, $tmp[$i]);
    }

    return ($response);
  }

  function 	call($url)
  {
  
    $class = '\Controller\\'.$this->class;
    $object = new $class();
    call_user_func_array(array($object, $this->method), $this->get_params($url));
  }
}
