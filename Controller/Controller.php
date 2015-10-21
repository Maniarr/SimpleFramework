<?php

trait Controller
{
  function 	view($name, $data)
  {
    $v = new View($name);
    $v->render($data);
  }
}