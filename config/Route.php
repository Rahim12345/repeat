<?php

namespace App\Framework;
class Route
{
    public static $route;

    public static function get($uri, $callback)
    {
        $uri = self::parseUri($uri);
//        if (empty($uri))
//        {
//            print_r(self::getLineWithString(file_get_contents(routes.'web.php'),'\'\''));
//            die();
////            die('Uri is required web.php');
//        }

        self::setRoute('GET',$uri,$callback);
    }

    private static function getLineWithString($fileName, $str) {
        $lines = file($fileName);
        $output = '';
        foreach ($lines as $lineNumber => $line) {
            if (strpos($line, $str) !== false) {
                $output .= "<b>$line</b>";
            }
            else
            {
                $output .= $line. "\n";
            }
        }

//        return $output;
    }

    public static function post($uri, $callback)
    {
        self::setRoute('POST',$uri,$callback);
    }

    public static function setRoute($method,$uri,$callback)
    {
        self::$route[$method][$uri] = $callback;
    }

    public static function getRoute()
    {
        return self::$route;
    }

    private static function parseUri($uri)
    {
        if (isset($uri[0]) && $uri[0] != '/')
        {
            $uri = '/'.$uri;
        }

        return $uri;
    }

    public static function run()
    {
        $routes = self::$route;
        $method = $_SERVER['REQUEST_METHOD'];
        $uri    = $_SERVER['REQUEST_URI'];
        if (isset(self::$route[$method][$uri]))
        {
            $callback = self::$route[$method][$uri];
            if (is_array($callback))
            {
                echo call_user_func_array([new $callback[0],$callback[1]],[]);
            }
            else
            {
                echo call_user_func_array($callback,[]);
            }
        }
        else
        {
            echo 404;
        }
    }
}