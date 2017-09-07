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
            Service\AsmlActivities::class => InvokableFactory::class,
        ],
        'aliases' => [
            'Service\AsmlActivities' => Service\AsmlActivities::class,
	],
    ],
    'router' => [
        'routes' => [
            'asml' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/asml',
                    'defaults' => [
                        'controller' => Controller\AsmlController::class,
                        'action'     => 'index',
                    	],
		],
		'may_terminate' => true,
                'child_routes' => [
                    'sections' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/sections',
                            'defaults' => [
                                'action' => 'sectionsList',
                            ],
                        ],
                    ],
                    'activities' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/activities',
                            'defaults' => [
                                'action' => 'activitiesList',
                            ],
                        ],
                    ],
                ],
            ],
	],
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
