<?php

use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Shared\ZedRequest\ZedRequestConstants;

$config[ApplicationConstants::ZED_SSL_ENABLED] = false;
$config[ApplicationConstants::HOST_ZED] = getenv('HOST_YVES') ?: 'localhost';
$config[ApplicationConstants::PORT_ZED] = getenv('PORT_YVES') ?: '8080';
$config[ApplicationConstants::BASE_URL_ZED] = sprintf(
    'http://%s:%s',
    $config[ApplicationConstants::HOST_ZED],
    $config[ApplicationConstants::PORT_ZED]
);

$config[ZedRequestConstants::ZED_API_SSL_ENABLED] = false;

$config[ZedRequestConstants::HOST_ZED_API] = getenv('HOST_ZED') ?: 'localhost';
$config[ZedRequestConstants::BASE_URL_ZED_API] = 'http://localhost:8081';
$config[ZedRequestConstants::AUTH_DEFAULT_CREDENTIALS] = [
    'yves_system' => [
        'rules' => [
            [
                'bundle' => '*',
                'controller' => 'gateway',
                'action' => '*',
            ],
        ],
        'token' => 'JDJ5JDEwJFE0cXBwYnVVTTV6YVZXSnVmM2l1UWVhRE94WkQ4UjBUeHBEWTNHZlFRTEd4U2F6QVBqejQ2', // Please replace this token for your project
    ],
];
