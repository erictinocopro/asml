<?php

namespace Asml\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class AsmlControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $service = (null === $options) ? new $requestedName : new $requestedName($options);
        return $service->setServiceManager($container);
    }
}
