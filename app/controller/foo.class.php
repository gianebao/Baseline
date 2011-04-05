<?php
namespace App\Controller;

class Foo
{
    protected $message = '';
    
    public function __construct($demo = null)
    {
        if (!empty($demo))
        {
            $this->message = $demo->say('child of foo');
        }
    }
    
    public function say($message = '')
    {
        echo empty($message) ? 'default: ' . $this->message: 'saying: ' . $message;
    }
}