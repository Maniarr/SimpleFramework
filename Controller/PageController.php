<?php

namespace Controller;

use Controller\Controller;

class PageController extends Controller
{
	public function index($hello)
	{
		echo 'index function : '.$hello;
	}

	public function error_404()
	{
		echo '404 error';
	}
}