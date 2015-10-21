<?php

class TestController
{
  use Controller;

  function 	hello($t = "World")
  {
    $this->view("hello", array("name" => $t));
  }  

  function 	info($str)
  {
    $this->view("info", array("name" => $str, "length" => strlen($str)));
  }
}