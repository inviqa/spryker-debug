<?php

use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Shared\Router\RouterConstants;

$config[RouterConstants::YVES_IS_SSL_ENABLED] = false;
$config[RouterConstants::YVES_SSL_EXCLUDED_ROUTE_NAMES] = ['/'];
$config[ApplicationConstants::HOST_YVES] = getenv('HOST_YVES') ?: 'localhost';
$config[ApplicationConstants::PORT_YVES] = getenv('PORT_YVES') ?: '8085';
$config[ApplicationConstants::BASE_URL_YVES] = sprintf(
    'http://%s:%s',
    $config[ApplicationConstants::HOST_YVES],
    $config[ApplicationConstants::PORT_YVES]
);
$config[ApplicationConstants::BASE_URL_SSL_YVES] = sprintf(
    'http://%s:%s',
    $config[ApplicationConstants::HOST_YVES],
    $config[ApplicationConstants::PORT_YVES]
);
