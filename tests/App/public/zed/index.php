<?php

use Pyz\Zed\Application\Communication\ZedBootstrap;
use Spryker\Shared\Config\Application\Environment;
use Spryker\Shared\ErrorHandler\ErrorHandlerEnvironment;

define('APPLICATION', 'ZED');
define('APPLICATION_ROOT_DIR', realpath(__DIR__ . '/../..'));
define('APPLICATION_CODE_BUCKET', 'Foobar');
define('APPLICATION_VENDOR_DIR', __DIR__ . '/../../../../vendor');
define('APPLICATION_ENV', 'development');
define('APPLICATION_STORE', 'GB');

require_once APPLICATION_VENDOR_DIR . '/autoload.php';

Environment::initialize();

$errorHandlerEnvironment = new ErrorHandlerEnvironment();
$errorHandlerEnvironment->initialize();

$bootstrap = new ZedBootstrap();
$bootstrap
    ->boot()
    ->run();
