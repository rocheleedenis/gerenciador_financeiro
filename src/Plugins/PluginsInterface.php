<?php

namespace SonFin\Plugins;

use SonFin\ServiceContainerInterface;

interface PluginInterface
{
    public function register(ServiceContainerInterface $container);
}