<?php

use Psr\Http\Message\ServerRequestInterface;
use SonFin\Application;
use SonFin\Plugins\DbPlugin;
use SonFin\Plugins\RoutePlugin;
use SonFin\Plugins\ViewPlugin;
use SonFin\ServiceContainer;
use Zend\Diactoros\Response;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app              = new Application($serviceContainer);

$app->plugin(new RoutePlugin);
$app->plugin(new ViewPlugin);
$app->plugin(new DbPlugin);

$app->get('/category-costs', function (ServerRequestInterface $request) use ($app) {
    $view = $app->service('view.renderer');
    $model = new \SonFin\Models\CategoryCost();
    $categories = $model->all();

    return $view->render('category-costs/list.html.twig', [
        'categories' => $categories,
    ]);
});

$app->get('/home/{name}/{id}', function (ServerRequestInterface $request) {
    $response = new Response();
    $response->getBody()->write($request->getAttribute('name'));

    return $response;
});

$app->start();
