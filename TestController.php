<?php

class TestController
{
  use Controller;

  function 	hello($t = "World")
  {
    $this->view("hello", array("name" => $t));
  }  
}