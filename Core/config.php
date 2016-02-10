<?php
	define('DS', DIRECTORY_SEPARATOR);
	define('BASE_PATH', str_replace(DS.'Core', '', dirname(__FILE__).DS));
	define('BASE_URL', str_replace('/index.php', '',$_SERVER['SCRIPT_NAME']));
	define('URL', 'http://'.$_SERVER['HTTP_HOST'].''.str_replace('/index.php', '',$_SERVER['SCRIPT_NAME']));
