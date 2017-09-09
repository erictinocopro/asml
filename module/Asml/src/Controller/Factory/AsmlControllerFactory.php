<?php

namespace Asml\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class AsmlControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        $service = (null === $options) ? new $requestedName($config) : new $requestedName($options, $config);
        return $service->setServiceManager($container);
    }
}
