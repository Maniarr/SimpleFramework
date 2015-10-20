<?php
// router.php for ROUTER in /Users/marzi_n/Documents/router
// 
// Made by MARZI Nicolas
// Login   <marzi_n@etna-alternance.net>
// 
// Started on  Tue Oct 20 08:34:52 2015 MARZI Nicolas
// Last update Tue Oct 20 09:07:32 2015 MARZI Nicolas
//

function autoload($path)
{
    $dir = opendir($path);
    while ($file = readdir($dir))
    {
        $tmp = explode('.', $file);
        if (($file != '.' && $file != '..') && is_dir($file))
            autoload($path.DIRECTORY_SEPARATOR.$file);
        else if (count($tmp) == 2 && ($tmp[1] == "php" && $tmp[0] != "router"))
            require($path.DIRECTORY_SEPARATOR.$file);
    }
    closedir($dir);
}

autoload(realpath('.'));

$input = array_slice($argv, 1);
$tmp = array();
$push = array();
$i = 0;

foreach($input as $element)
{
  if ($element != "x")
    array_push($push, $element);
  else
  {
    array_push($tmp, $push);
    $push = array();
  }
}
array_push($tmp, $push);

foreach($tmp as $element)
{
  if ($element[0] == "echo")
  {
    $func = $element[1];
    $params = array_slice($element, 2);
    $response = call_user_func_array($func, $params);
    echo "Return : ".$response."\n";
  }
  else
  {
    $func = $element[0];
    $params = array_slice($element, 1);
    call_user_func_array($func, $params);
  }
  echo "\n";
}