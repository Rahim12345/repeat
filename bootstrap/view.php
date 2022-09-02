<?php



function view($name)
{
    $name = view . str_replace('.',DIRECTORY_SEPARATOR,$name) . '.blade.php';
    ob_start();
    require_once $name;
    $buffer = ob_get_clean();
    return $buffer;
}