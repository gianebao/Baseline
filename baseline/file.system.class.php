<?php
namespace Baseline;

/**
 * File System class
 * Collection of standardizations for Baseline.
 * 
 * @package Baseline
 * @author Gian Carlo Val Ebao <gianebao@gmail.com>
 */
class FileSystem
{
    
    /**
     * root path
     * @access private
     */
    private static $root = '';
    
    /**
     * last error message set when parsing
     * @acces private
     * */
    private static $lastErrorMessage = '';
    
    /**
     * Returns the value root path.
     * 
     * @return string
     */
    public static function getRoot()
    {
        return self::$root;
    }
    
    /**
     * Sets the value for root
     */
    public static function setRoot()
    {
        self::$root = dirname(__FILE__);
    }
    
    public static function startAutoLoad()
    {
        spl_autoload_register(array('Baseline\\FileSystem', 'loadClass'));
    }
    
    public static function getPath($class)
    {
        if (0 < strpos('\\', $class))
        {
            self::$lastErrorMessage = 'Cannot load class [' .
                implode('\\', $class) . '] with no namespace.';
            return false;
        }
        
        return Standard::toPath($class, array('baseline' => self::getRoot()));
    }
    
    public static function loadClass($class)
    {
        $path = self::getPath($class);
        
        if (false === $path)
        {
            trigger_error(self::$lastErrorMessage, E_USER_ERROR);
        }
        
        if (!file_exists($path))
        {
            trigger_error($path . ' not found.', E_USER_ERROR);
        }
        
        require $path;
        
        
        if (!class_exists($class))
        {
            trigger_error('Class "' . $class . '" not found in ' . $path . '.', E_USER_ERROR);
        }
    }
}
// END