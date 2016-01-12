<?php

class PageController extends Controller
{
  function index()
  {
    $this->view('index');
  }

  function route_404()
  {
    $this->redirect('/');
  }
}
