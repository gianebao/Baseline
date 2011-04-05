<?php
namespace Baseline;

/**
 * Standard class
 * Collection of standardizations for Baseline.
 * 
 * @package Baseline
 * @author Gian Carlo Val Ebao <gianebao@gmail.com>
 */
class Standard
{
    
    /**
     * creates a filesystem path from a class name.
     *
     * @param string $class class name
     * @param array $nsRootPathMap associative map of a namespace to
     * file system path
     * @return string
     * @author Gian Carlo Val Ebao
     */
    public static function toPath($class, $nsRootPathMap = array())
    {
        $class = explode('\\', $class);
        $rule = array(
            'search' => array ('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
                 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W',
                 'X', 'Y', 'Z'),
                 
            'replace' => array ('.a', '.b', '.c', '.d', '.e', '.f', '.g', '.h',
                '.i', '.j','.k', '.l', '.m', '.n', '.o', '.p', '.q', '.r', '.s',
                '.t', '.u', '.v', '.w', '.x', '.y', '.z')
        );
        
        $namespace = strtolower(array_shift($class));
        $path = isset($nsRootPathMap[strtolower($namespace)]) ?
            $nsRootPathMap[$namespace]: $namespace;

        $file = str_replace($rule['search'], $rule['replace'],
            lcfirst(array_pop($class))) . '.class.php';
        
        if (!empty($class))
        {
            $i = count($class) - 1;
            do
            {
                $class[$i] = strtolower($class[$i]);
            } while(0 < --$i);
            
            $path .= '/' . implode('/', $class);
        }
        
        return $path . '/' . $file;
    }

    /**
     * converts a string to a valid class name.
     * 
     * @param string $str text to be converted
     * @return string
     * @author Gian Carlo Val Ebao
     */
    public static function toName($str)
    {
        $str = strtolower($str);
        
        if (false === strpos($str, '_') && false === strpos($str, '-')) {
            return $str;
        }
        
        $str = str_replace(array('_', '-'), ' ', trim($str, ' _-'));
        return str_replace(array('_', '-', ' '), '',
             ucwords('_' . strtolower($str)));
    }
}
// END
