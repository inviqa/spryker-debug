<?php

namespace Pyz\Yves\Http;

use Spryker\Yves\Http\HttpDependencyProvider as SprykerHttpDependencyProvider;
use Spryker\Yves\Http\Plugin\Http\InlineRendererFragmentHandlerPlugin;
use Spryker\Yves\Kernel\Container;

class HttpDependencyProvider extends SprykerHttpDependencyProvider
{
    protected function getFragmentHandlerPlugins(): array
    {
        return [
            new InlineRendererFragmentHandlerPlugin(),
        ];
    }
}
