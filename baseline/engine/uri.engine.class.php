<?php
namespace Baseline\Engine;

class UriEngine extends Engine
{
    const KEY = 0;
    
    public static function start($config)
    {
        parent::start($config);
        
        $cmd = '';
        if (!empty($_GET))
        {
            $cmd = array_keys($_GET);
            $cmd = $cmd[self::KEY];
        }
        
        if (empty($config['routes']))
        {
            throw new Exception('"routes" configuration was not declared.');
        }
        
        $route = \Baseline\Route\Builder::apply($cmd, $config['routes']);
    }
}