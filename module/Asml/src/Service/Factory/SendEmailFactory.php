<?php

namespace Asml\Service\Factory;

use Asml\Service\SendEmail;
use Mailjet\Client;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class SendEmailFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config')['Mailjet'];
        $sendmailClient = new Client($config['Api']['apikey'], $config['Api']['secretkey'], true, ['version' => 'v3.1']);
        $service = (null === $options) ? new $requestedName($sendmailClient) : new $requestedName($sendmailClient, $options);
        return $service->setServiceManager($container);
    }
}
