<?php
namespace App\Route;

class Common extends \Baseline\Route\Rule
{
    public function __construct($commands)
    {
        $controller = array_shift($commands);
        $controller = '\\App\\Controller\\' . $controller;
        $controller = new $controller();
        if (!empty($commands))
        {
            $action = array_shift($commands);
            call_user_func_array(array($controller, $action), $commands);
        }
    }
}
