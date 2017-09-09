<?php

namespace Asml;

use Zend\Router\Http\Segment;
use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            Controller\AsmlController::class => Controller\Factory\AsmlControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            Service\AsmlActivities::class => Service\Factory\AsmlActivitiesFactory::class,
            Service\SendEmail::class => Service\Factory\SendEmailFactory::class,
        ],
        'aliases' => [
            'Service\AsmlActivities' => Service\AsmlActivities::class,
            'Service\SendEmail' => Service\SendEmail::class,
        ],
    ],
    'router' => include 'routes.config.php',
    'session_containers' => [
        'UserRegistration',
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
        'template_path_stack' => [
            'album' => __DIR__ . '/../view',
        ],
    ],
];
