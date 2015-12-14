<?php

class Route
{
  public 	$url;
  private 	$class;
  private	$method;

  function 	__construct($url, $function)
  {
    $tmp = explode('::', $function);

    $this->url = $url;
    $this->class = $tmp[0];
    $this->method = $tmp[1];
  }

  function	equal_url($url)
  {
    $original = explode('/', $this->url);

    if ($url[strlen($url) - 1] == '/')
        $url = substr($url, 0, -1);

    $tmp = explode('/', $url);

    for ($i = 0; $i < count($original); $i++)
    {
      if (isset($original[$i]) && isset($tmp[$i]) && ($original[$i] != $tmp[$i]) )
      {
    	if (preg_match('/^{[a-zA-z]+}$/', $original[$i]))
    	{
    	  if ($tmp[$i] == false)
    	    return (0);
    	}
    	else
    	  return (0);
      }
    }
    if (count($tmp) != count($original))
      return (0);
    return (1);
  }

  function	get_params($url)
  {
    $response = array();
    $original = explode('/', $this->url);
    $tmp = explode('/', $url);

    for ($i = 0; $i < count($original); $i++)
    {
      if (preg_match('/^{[a-zA-z]+}$/', $original[$i]))
	array_push($response, $tmp[$i]);
    }

    return ($response);
  }

  function 	call($url)
  {
    $class = new ReflectionClass($this->class);
    $object = $class->newInstanceArgs();
    call_user_func_array(array($object, $this->method), $this->get_params($url));
  }
}
