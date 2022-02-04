<?php

namespace Pyz\Yves\ShopApplication;

use Spryker\Yves\EventDispatcher\Plugin\Application\EventDispatcherApplicationPlugin;
use Spryker\Yves\Http\Plugin\Application\HttpApplicationPlugin;
use Spryker\Yves\Router\Plugin\Application\RouterApplicationPlugin;
use Spryker\Yves\Twig\Plugin\Application\TwigApplicationPlugin;
use SprykerShop\Yves\ShopApplication\Plugin\Application\ShopApplicationApplicationPlugin;
use SprykerShop\Yves\ShopApplication\ShopApplicationDependencyProvider as SprykerShopApplicationDependencyProvider;

class ShopApplicationDependencyProvider extends SprykerShopApplicationDependencyProvider
{
    /**
     * @return \Spryker\Shared\ApplicationExtension\Dependency\Plugin\ApplicationPluginInterface[]
     */
    protected function getApplicationPlugins(): array
    {
        return [
            new TwigApplicationPlugin(),
            new ShopApplicationApplicationPlugin(),
            new EventDispatcherApplicationPlugin(),
            new RouterApplicationPlugin(),
            new HttpApplicationPlugin(),
        ];
    }
}
