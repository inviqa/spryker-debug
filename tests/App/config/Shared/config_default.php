<?php

use Spryker\Shared\ErrorHandler\ErrorHandlerConstants;
use Spryker\Shared\Kernel\KernelConstants;

$config[KernelConstants::PROJECT_NAMESPACE] = 'Pyz';
$config[KernelConstants::PROJECT_NAMESPACES] = [
    'Pyz',
];
$config[KernelConstants::CORE_NAMESPACES] = [
    'SprykerShop',
    'SprykerMiddleware',
    'SprykerEco',
    'Spryker',
];
$config[KernelConstants::PROJECT_NAMESPACE] = 'Pyz';
$config[ErrorHandlerConstants::ERROR_LEVEL] = 8191;

require __DIR__ . '/database.php';
