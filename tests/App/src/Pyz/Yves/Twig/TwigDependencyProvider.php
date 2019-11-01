<?php

namespace Pyz\Yves\Twig;

use SprykerShop\Yves\WebProfilerWidget\Plugin\Twig\WebProfilerTwigLoaderPlugin;
use Spryker\Shared\Twig\Plugin\HttpKernelTwigPlugin;
use Spryker\Shared\Twig\Plugin\RoutingTwigPlugin;
use Spryker\Yves\Http\Plugin\Twig\RuntimeLoaderTwigPlugin;
use Spryker\Yves\Kernel\Container;
use Spryker\Yves\Twig\TwigDependencyProvider as SprykerTwigDependencyProvider;

class TwigDependencyProvider extends SprykerTwigDependencyProvider
{
    protected function getTwigLoaderPlugins(): array
    {
        return [
            new WebProfilerTwigLoaderPlugin(),
        ];
    }

    protected function getTwigPlugins(): array
    {
        return [
            new RoutingTwigPlugin(),
            new HttpKernelTwigPlugin(),
            new RuntimeLoaderTwigPlugin(),
        ];
    }
}
