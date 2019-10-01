<?php

namespace Pyz\Tests;

use Pyz\Shared\FeatureFlags\FeatureFlagsServiceProvider;
use Pyz\Yves\ShopApplication\YvesBootstrap;
use Pyz\Zed\Application\Communication\ZedBootstrap;
use Pyz\Zed\Application\Environment;
use Spryker\Shared\Kernel\Communication\Application as ZedApplication;
use Spryker\Yves\Kernel\Application as YvesApplication;
use Spryker\Yves\Session\Plugin\ServiceProvider\SessionServiceProvider;
use Spryder\Zed\Propel\Communication\Plugin\ServiceProvider\PropelServiceProvider;

final class BootstrapUtil
{
    public static function initApplication(string $app)
    {
        defined('APPLICATION') || define('APPLICATION', $app);
        defined('APPLICATION_ROOT_DIR') || define('APPLICATION_ROOT_DIR', __DIR__ . '/..');
        defined('APPLICATION_ENV') || define('APPLICATION_ENV', getenv('APPLICATION_ENV') ?: 'devtest');
        defined('APPLICATION_STORE') || define('APPLICATION_STORE', getenv('APPLICATION_STORE') ?: 'RO_STOREDEPOT_00011');
    }
}
