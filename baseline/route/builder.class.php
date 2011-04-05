<?php
namespace Baseline\Route;

class Builder
{
    const INDEX = 'Index';
    const COMMON = 'Common';
    
    public static function apply($cmd, $rulesNamespace)
    {
        $cmd = explode('/', $cmd);
        
        if (!empty($cmd[0]))
        {
            $class = $rulesNamespace . '\\' . \Baseline\Standard::toName($cmd[0]);
            
            $classPath = \Baseline\FileSystem::getPath($class);
            
            $class = file_exists($classPath) ? $class:
                 $rulesNamespace . '\\' . self::COMMON;
        }
        else
        {
            $class = $rulesNamespace . '\\' . self::INDEX;
        }
        
        return new $class($cmd);
    }
}