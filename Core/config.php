<?php
define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', str_replace('/Core', '', dirname(__FILE__).DS));
define('BASE_URL', str_replace('/index.php', '',$_SERVER['SCRIPT_NAME']));

$load = array(
  "Route"  	=> "Core\Routing\Route",
  "Router" 	=> "Core\Routing\Router",
  "View"	=> "Core\View",
  "Controller"  => "Controller\Controller"
);
?>
