<?php

class Autoloader
{
	static function register()
	{
		spl_autoload_register(array(__CLASS__, 'load'));
	}

	static function load($class)
	{
		$class = str_replace('\\', DS, $class);
		require_once BASE_PATH.$class.'.php';
	}
}