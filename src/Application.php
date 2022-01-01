<?php

namespace SonFin;

use Psr\Http\Message\RequestInterface;
use SonFin\Plugins\PluginInterface;
use SonFin\ServiceContainerInterface;

class Application
{
    private $serviceContainer;

    public function __construct(ServiceContainerInterface $serviceContainer)
    {
        $this->serviceContainer = $serviceContainer;
    }

    public function service($name)
    {
        return $this->serviceContainer->get($name);
    }

    public function addService(string $name, $service)
    {
        if (is_callable($service)) {
            $this->serviceContainer->addLazy($name, $service);
        } else {
            $this->serviceContainer->add($name, $service);
        }
    }

    public function plugin(PluginInterface $plugin) : void
    {
        $plugin->register($this->serviceContainer);
    }

    public function get($path, $action, $name = null) : self
    {
        $routing = $this->service('routing');
        $routing->get($name, $path, $action);

        return $this;
    }

    public function start()
    {
        $route = $this->service('route');

        if (!$route) {
            echo 'Page not found';
            exit;
        }

        $request = $this->service(RequestInterface::class);
        foreach ($route->attributes as $key => $value) {
            $request = $request->withAttribute($key, $value);
        }

        $callable = $route->handler;
        $callable($request);
    }
}
