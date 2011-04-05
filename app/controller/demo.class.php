<?php
namespace App\Controller;

class Demo
{
    public $message = '';
    
    public function __construct($message = '')
    {
        $this->message = $message;
    }
    
    public function say($message = '')
    {
        $message = empty($message) ? 'demo -- construct: ' . $this->message:  '-- demo --' . $message;
        echo $message . "\n";
        
        print_r(debug_backtrace());
        
        return $message;
    }
}