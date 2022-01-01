<?php

use SonFin\Application;
use SonFin\Plugins\RoutePlugin;
use SonFin\ServiceContainer;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app              = new Application($serviceContainer);

$app->plugin(new RoutePlugin);

$app->get('/', function () {
    echo 'Hello world';
});

$app->get('/home', function () {
    echo 'Home page';
});

$app->start();
