<?php

use Zend\Session\Storage\SessionArrayStorage;
use Zend\Session\Validator\RemoteAddr;
use Zend\Session\Validator\HttpUserAgent;

return [
    'session_config' => [
        'cookie_lifetime' => 60*60*1,     
        'gc_maxlifetime'  => 60*60*24*30, 
        'cookie_secure'   => true,
        'phpSaveHandler'  => 'redis',
        'savePath'        => 'tcp://127.0.0.1:6379?weight=1&timeout=1&auth=1d0ntG1v3AFuCk!',
    ],
    'session_manager' => [
        'validators' => [
            RemoteAddr::class,
            HttpUserAgent::class,
        ]
    ],
    'session_storage' => [
        'type' => SessionArrayStorage::class
    ],
];
