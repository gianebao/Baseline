<?php
namespace Baseline\Handler;

class Exception extends Handler
{
    public static function startListener()
    {
        set_exception_handler(array('Baseline\\Handler\\Exception', 'handle'));
    }
    
    public static function handle($exception)
    {
        parent::handle($exception->getMessage());
    }
}