<?php

namespace Controller;

use Controller\Controller;

class PageController extends Controller
{
	public function index()
	{
		echo 'Hello world ';
	}

	public function error_404()
	{
		echo '404 error';
	}
}