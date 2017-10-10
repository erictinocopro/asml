<?php

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'routes' => [
        'home' => [
            'type' => Segment::class,
            'options' => [
                'route' => '/home',
                'defaults' => [
                    'controller' => \Asml\Controller\AsmlController::class,
                    'action'     => 'home',
                ],
            ],
        ],
        'asml' => [
            'type'    => Segment::class,
            'options' => [
                'route' => '/',
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
                        'route' => 'sections',
                        'defaults' => [
                            'action' => 'sectionsList',
                        ],
                    ],
                ],
                'activities' => [
                    'type' => Literal::class,
                    'options' => [
                        'route' => 'activities',
                        'defaults' => [
                            'action' => 'activitiesList',
                        ],
                    ],
                ],
                'savedata' => [
                    'type' => Literal::class,
                    'options' => [
                        'route' => 'save',
                        'defaults' => [
                            'action' => 'saveData',
                        ],
                    ], 
                ],
                'deletedata' => [
                    'type' => Literal::class,
                    'options' => [
                        'route' => 'clean',
                        'defaults' => [
                            'action' => 'cleanData',
                        ],
                    ], 
                ],
                'uploadphoto' => [
                    'type' => Literal::class,
                    'options' => [
                        'route' => 'uploadphoto',
                        'defaults' => [
                            'action' => 'uploadPhoto',
                        ]
                    ],
                ],
            ],
        ],
		'login' => [
			'type' => Literal::class,
			'options' => [
				'route'    => '/login',
				'defaults' => [
					'controller' => \Asml\Controller\AsmlAuthController::class,
					'action'     => 'login',
				],
			],
		],
		'logout' => [
			'type' => Literal::class,
			'options' => [
				'route'    => '/logout',
				'defaults' => [
					'controller' => \Asml\Controller\AsmlAuthController::class,
					'action'     => 'logout',
				],
			],
		],
    ],
];
