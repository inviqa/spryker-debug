<?php

use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Shared\ErrorHandler\ErrorHandlerConstants;
use Spryker\Shared\Kernel\KernelConstants;
use Spryker\Shared\Log\LogConstants;

$config[KernelConstants::PROJECT_NAMESPACE] = 'Pyz';
$config[KernelConstants::PROJECT_NAMESPACES] = [
    'Pyz',
    'Inviqa',
];
$config[KernelConstants::CORE_NAMESPACES] = [
    'SprykerShop',
    'SprykerMiddleware',
    'SprykerEco',
    'Spryker',
];
$config[KernelConstants::PROJECT_NAMESPACE] = 'Pyz';
$config[ErrorHandlerConstants::ERROR_LEVEL] = 8191;
$config[KernelConstants::SPRYKER_ROOT] = APPLICATION_ROOT_DIR . '/../../vendor/spryker';
$config[LogConstants::LOG_LEVEL] = LOG_DEBUG;

require __DIR__ . '/../database.php';
require __DIR__ . '/../storage.php';
require __DIR__ . '/../rabbitmq.php';
require __DIR__ . '/../twig.php';
require __DIR__ . '/../var_dump_server.php';
