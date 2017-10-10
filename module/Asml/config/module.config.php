<?php

namespace Asml;

use Zend\Router\Http\Segment;
use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            Controller\AsmlController::class => Controller\Factory\AsmlControllerFactory::class,
            Controller\AsmlAuthController::class => Controller\Factory\AsmlAuthControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            Service\AsmlActivities::class => Service\Factory\AsmlActivitiesFactory::class,
            Service\SendEmail::class => Service\Factory\SendEmailFactory::class,
            \Zend\Authentication\AuthenticationService::class => Service\Factory\AuthenticationServiceFactory::class,
            Service\AuthAdapter::class => Service\Factory\AuthAdapterFactory::class,
            Service\AuthManager::class => Service\Factory\AuthManagerFactory::class,
        ],
        'aliases' => [
            'Service\AsmlActivities' => Service\AsmlActivities::class,
            'Service\SendEmail' => Service\SendEmail::class,
        ],
    ],
    'router' => include 'routes.config.php',
    'access_filter' => [
    	'controllers' => [
        	Controller\AsmlController::class => [
            	['actions' => ['index', 'save', 'clean', 'sectionsList', 'activitiesList', ], 'allow' => '*'],
            	['actions' => ['home'], 'allow' => '@'],
        	],
            Controller\AsmlAuthController::class => [
            	['actions' => ['login'], 'allow' => '*'],
            	['actions' => ['logout'], 'allow' => '@'],
        	],
    	]
	],
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
