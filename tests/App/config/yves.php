<?php

use Spryker\Shared\Application\ApplicationConstants;

$config[ApplicationConstants::HOST_YVES] = 'localhost';
$config[ApplicationConstants::PORT_YVES] = '8086';
$config[ApplicationConstants::BASE_URL_YVES] = sprintf(
    'http://%s:%s',
    $config[ApplicationConstants::HOST_YVES],
    $config[ApplicationConstants::PORT_YVES]
);
