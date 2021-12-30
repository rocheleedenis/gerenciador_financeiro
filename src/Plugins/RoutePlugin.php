<?php

use SonFin\Plugins\PluginInterface;
use Aura\Router\RouterContainer;
use SonFin\ServiceContainerInterface;

class RoutePlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $routeContainer = new RouterContainer();
        /* Registrar as rotas da aplicação */
        $map = $routeContainer->getMap();
        /* Tem a função identificar a rota que está sendo acessada */
        $matcher = $routeContainer->getMatcher();
        /* Tem a função de gerar links com base nas rotas registradas */
        $generator = $routeContainer->getGenerator();

        $container->add('routing', $map);
        $container->add('routing.matcher', $matcher);
        $container->add('routing.generator', $generator);
    }
}
