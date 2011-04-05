<?php
namespace Baseline;

class Config
{
    public $data = array();

    public function __construct($file)
    {
        if (!file_exists($file))
        {
            throw new \Exception($file . ' not found.');
        }
        
        $config = array();
        
        \Route::set();
        //require $file;
        
        if (!is_array($config))
        {
            throw new \Exception($file . ' is not a valid php config file. $config must be used.');
        }
        
        $this->data = $config;
    }
}