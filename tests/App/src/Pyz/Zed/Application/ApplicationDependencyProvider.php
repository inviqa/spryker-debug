<?php

namespace Pyz\Zed\Application;

use Inviqa\Shared\SprykerDebug\Plugin\Application\TwigVarDumpApplicationPlugin;
use Spryker\Zed\Application\ApplicationDependencyProvider as SprykerApplicationDependencyProvider;
use Spryker\Zed\EventDispatcher\Communication\Plugin\Application\EventDispatcherApplicationPlugin;
use Spryker\Zed\Http\Communication\Plugin\Application\HttpApplicationPlugin;
use Spryker\Zed\Propel\Communication\Plugin\Application\PropelApplicationPlugin;
use Spryker\Zed\Twig\Communication\Plugin\Application\TwigApplicationPlugin;

class ApplicationDependencyProvider extends SprykerApplicationDependencyProvider
{
    protected function getBackofficeApplicationPlugins(): array
    {
        return [
            new HttpApplicationPlugin(),
            new EventDispatcherApplicationPlugin(),
            new TwigVarDumpApplicationPlugin(),
            new TwigApplicationPlugin(),
            new PropelApplicationPlugin(),
        ];
    }
}
