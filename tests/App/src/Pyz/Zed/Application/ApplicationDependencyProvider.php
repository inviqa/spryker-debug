<?php

namespace Pyz\Zed\Application;

use Inviqa\Shared\SprykerDebug\Plugin\Application\TwigVarDumpApplicationPlugin;
use Spryker\Zed\Application\ApplicationDependencyProvider as SprykerApplicationDependencyProvider;

class ApplicationDependencyProvider extends SprykerApplicationDependencyProvider
{
    protected function getApplicationPlugins(): array
    {
        return [
            new TwigVarDumpApplicationPlugin(),
        ];
    }
}
