<?php

class Route
{
  public 	$url;
  public 	$function;

  function 	Route($url, $function)
  {
    $this->url = $url;
    $this->function = $function;
  }

  function	equal_url($url)
  {
    $original = explode('/', $this->url);
    $tmp = explode('/', $url);

    for ($i = 0; $i < count($original); $i++)
    {
      if ($original[$i] != $tmp[$i])
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
    $this->get_params($url);
    call_user_func_array($this->function, $this->get_params($url));
  }
}