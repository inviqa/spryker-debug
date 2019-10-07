<?php

namespace Pyz\Zed\Application;

use Inviqa\Yves\SprykerDebug\Plugin\Provider\TwigVarDumpServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Spryker\Zed\Application\ApplicationDependencyProvider as SprykerApplicationDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Propel\Communication\Plugin\ServiceProvider\PropelServiceProvider;
use Spryker\Zed\Twig\Communication\Plugin\ServiceProvider\TwigServiceProvider as SprykerTwigServiceProvider;

class ApplicationDependencyProvider extends SprykerApplicationDependencyProvider
{
    protected function getServiceProviders(Container $container)
    {
        return array_merge(parent::getServiceProviders($container), [
            new PropelServiceProvider(),
            new TwigServiceProvider(),
            new SprykerTwigServiceProvider(),
            new TwigVarDumpServiceProvider()
        ]);
    }
}
