<?php
namespace Baseline\Handler;

class Handler
{
    public static $msgFormat = "[%s] %s\n";
    
    public static function handle($message)
    {
        $backtrace = debug_backtrace();
        $backtrace = array_pop($backtrace);
        //print_r($backtrace);
        echo sprintf(self::$msgFormat, $backtrace['class'] . 'Exception', $message);
    }
}