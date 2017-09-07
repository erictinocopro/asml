<?php

namespace Asml\Service\Factory;

use Asml\Service\AsmlActivities;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class AsmlActivitiesFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $service = (null === $options) ? new $requestedName : new $requestedName($options);
        return $service->setServiceManager($container);
    }
}
