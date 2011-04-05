<?php 
declare(encoding='UTF-8');
error_reporting(E_ALL);

$ms = array_sum(explode(' ', microtime())); // setting the start time.

$baseline = 'baseline/';

require $baseline . 'standard.class.php';
require $baseline . 'file.system.class.php';
Baseline\FileSystem::setRoot();
Baseline\FileSystem::startAutoLoad();
Baseline\Handler\Exception::startListener();
Baseline\Handler\Error::startListener();

Baseline\Engine\UriEngine::start(array(
    'routes' => 'App\Route'
));

$ms = round((array_sum(explode(' ', microtime())) - $ms) * 1000, 4); // setting the end time.
echo '<pre>Done! ', $ms, 'ms</pre>';
