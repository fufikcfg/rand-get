<?php

define('APP_PATH', dirname(__DIR__));

require_once APP_PATH.'/kernel/Router/Router.php';
require_once APP_PATH.'/src/Controllers/RandomController.php';
require_once APP_PATH.'/src/Services/RandomGenerator.php';
require_once APP_PATH.'/src/Services/DataStorage.php';

$router = new Router();
$generator = new RandomGenerator();
$storage = new DataStorage();
$controller = new RandomController($generator, $storage);

$router->add('GET', '/random', [$controller, 'random']);
$router->add('GET', '/get', [$controller, 'get']);

$router->dispatch();