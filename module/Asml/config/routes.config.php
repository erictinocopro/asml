<?php

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'routes' => [
        'asml' => [
            'type'    => Segment::class,
            'options' => [
                'route' => '/asml',
                'defaults' => [
                    'controller' => \Asml\Controller\AsmlController::class,
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
                'savedata' => [
                    'type' => Literal::class,
                    'options' => [
                        'route' => '/save',
                        'defaults' => [
                            'action' => 'saveData',
                        ],
                    ], 
                ],
                'deletedata' => [
                    'type' => Literal::class,
                    'options' => [
                        'route' => '/clean',
                        'defaults' => [
                            'action' => 'cleanData',
                        ],
                    ], 
                ],
                'uploadphoto' => [
                    'type' => Literal::class,
                    'options' => [
                        'route' => '/uploadphoto',
                        'defaults' => [
                            'action' => 'uploadPhoto',
                        ]
                    ],
                ],
            ],
        ],
    ],
];
