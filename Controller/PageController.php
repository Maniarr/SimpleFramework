<?php

namespace Controller;

use Controller\Controller;

class PageController extends Controller
{
	public function index()
	{
		$test = $this->model('Message');
		$this->view('index');
	}
}