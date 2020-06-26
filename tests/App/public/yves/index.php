<?php

use Pyz\Yves\ShopApplication\YvesBootstrap;
use Spryker\Shared\Config\Application\Environment;

define('APPLICATION', 'YVES');
define('APPLICATION_ROOT_DIR', realpath(__DIR__ . '/../..'));
define('APPLICATION_CODE_BUCKET', 'Foobar');
define('APPLICATION_ENV', 'development');
define('APPLICATION_STORE', 'GB');
define('APPLICATION_VENDOR_DIR', __DIR__ . '/../../../../vendor');
define('APPLICATION_SOURCE_DIR', APPLICATION_ROOT_DIR . '/src');

require_once APPLICATION_VENDOR_DIR . '/autoload.php';

Environment::initialize();

$bootstrap = new YvesBootstrap();
$bootstrap
    ->boot()
    ->run();
