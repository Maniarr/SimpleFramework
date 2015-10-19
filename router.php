<?php

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

$func = $argv[1];
$params = array_slice($argv, 2);

call_user_func_array($func, $params);
