<?php

namespace Pyz\Yves\Router;

use Pyz\Yves\Test\Plugin\Router\TestRouteProviderPlugin;
use Spryker\Yves\Router\Plugin\Router\YvesRouterPlugin;
use Spryker\Yves\Router\RouterDependencyProvider as SprykerRouterDependencyProvider;

final class RouterDependencyProvider extends SprykerRouterDependencyProvider
{
    protected function getRouterPlugins(): array
    {
        return [
            new YvesRouterPlugin(),
        ];
    }

    protected function getRouteProvider(): array
    {
        return [
            new TestRouteProviderPlugin(),
        ];
    }
}
