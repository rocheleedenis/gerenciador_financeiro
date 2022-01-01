<?php

use Psr\Http\Message\RequestInterface;
use SonFin\Application;
use SonFin\ServiceContainer;
use SonFin\Plugins\RoutePlugin;
use Psr\Http\Message\ServerRequestInterface;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app              = new Application($serviceContainer);

$app->plugin(new RoutePlugin);

$app->get('/', function (RequestInterface $request) {
    var_dump($request->getUri());
});

$app->get('/home/{name}/{id}', function (ServerRequestInterface $request) {
    echo 'Home page';
    echo '</br>' . $request->getAttribute('name');
    echo '</br>' . $request->getAttribute('id');
});

$app->start();
