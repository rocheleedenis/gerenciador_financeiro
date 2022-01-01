<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use SonFin\Application;
use SonFin\Plugins\RoutePlugin;
use SonFin\ServiceContainer;
use Zend\Diactoros\Response;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app              = new Application($serviceContainer);

$app->plugin(new RoutePlugin);

$app->get('/', function (RequestInterface $request) {
    var_dump($request->getUri());
});

$app->get('/home/{name}/{id}', function (ServerRequestInterface $request) {
    $response = new Response();
    $response->getBody()->write($request->getAttribute('name'));

    return $response;
});

$app->start();
