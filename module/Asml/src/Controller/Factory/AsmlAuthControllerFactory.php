<?php

namespace Asml\Controller\Factory;

use Interop\Container\ContainerInterface;
use Asml\Controller\AsmlAuthController;
use Zend\ServiceManager\Factory\FactoryInterface;
use Asml\Service\AuthManager;

/**
 * This is the factory for AuthController. Its purpose is to instantiate the controller
 * and inject dependencies into its constructor.
 */

class AsmlAuthControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {   
        // $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $entityManager = null;
        $authManager = $container->get(AuthManager::class);
        $authService = $container->get(\Zend\Authentication\AuthenticationService::class);

        $config = $container->get('config');
        
        return new AsmlAuthController($entityManager, $authManager, $authService, $config);
    }
}
