<?php

namespace Pyz\Zed\Application;

use Inviqa\Shared\SprykerDebug\Plugin\Application\TwigVarDumpApplicationPlugin;
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
        ]);
    }

    protected function getApplicationPlugins(): array
    {
        return [
            new TwigVarDumpApplicationPlugin(),
        ];
    }
}
