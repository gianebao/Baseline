<?php
namespace App\Route;

class Index extends \Baseline\Route\Rule
{
    public function __construct()
    {
        $demo = new \App\Controller\Demo();
        $demo->say('I\'m running inside the index route.');
    }
}
