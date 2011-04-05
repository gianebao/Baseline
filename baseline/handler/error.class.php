<?php
namespace Baseline\Handler;

class Error extends Handler
{
    public static function startListener()
    {
        set_error_handler(array('Baseline\\Handler\\Error', 'handle'), E_USER_NOTICE | E_USER_WARNING | E_USER_ERROR);
    }
    
    public static function handle($no, $str, $file, $line, $context)
    {
        parent::handle($str);
        exit();
    }
}