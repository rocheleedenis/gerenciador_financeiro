<?php

use SonFin\Plugins\PluginInterface;
use Aura\Router\RouterContainer;
use SonFin\ServiceContainerInterface;
use Psr\Http\Message\RequestInterface;
use Zend\Diactoros\ServerRequestFactory;

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

        $request = $this->getRequest();

        $container->add('routing', $map);
        $container->add('routing.matcher', $matcher);
        $container->add('routing.generator', $generator);
        $container->add(RequestInterface::class, $request);

        $container->addLazy('route', function (ContainerInterface $container) {
            $matcher = $container->get('route.matcher');
            $request = $container->get(RequestInterface::class);

            return $matcher->match($request);
        });
    }

    protected function getRequest(): RequestInterface
    {
        return ServerRequestFactory::fromGlobals(
            $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
        );
    }
}
