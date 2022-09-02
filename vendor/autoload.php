<?php

spl_autoload_register('loader');

function loader($className){
    if (!strpos($className,'App\\'))
    {
        $className = str_replace('App','app',$className);
    }

    if (!strpos($className,'app\Framework\\'))
    {
        $className = str_replace('app\Framework','config',$className);
    }

    $file = $className.'.php';
//    echo $file;
    if (!file_exists($file))
    {
        throw new \Exception();
    }

    require_once $file;
}