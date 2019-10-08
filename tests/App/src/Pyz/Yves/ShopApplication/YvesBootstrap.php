<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ShopApplication;

use Inviqa\Yves\SprykerDebug\Plugin\SprykerDebugControllerProvider;
use Pyz\Yves\Test\Plugin\Provider\TestControllerProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Spryker\Shared\Application\Business\Routing\SilexRouter;
use Spryker\Shared\Application\ServiceProvider\RoutingServiceProvider;
use Spryker\Shared\ErrorHandler\Plugin\ServiceProvider\WhoopsErrorHandlerServiceProvider;
use SprykerShop\Yves\ShopApplication\YvesBootstrap as SprykerYvesBootstrap;

class YvesBootstrap extends SprykerYvesBootstrap
{
    protected function registerServiceProviders(): void
    {
        $this->application['debug'] = true;
        $this->application->register(new ServiceControllerServiceProvider());
        $this->application->register(new RoutingServiceProvider());
        $this->application->register(new WhoopsErrorHandlerServiceProvider());
    }

    protected function registerRouters(): void
    {
        $this->application->addRouter(new SilexRouter($this->application));
    }

    /**
     * @return void
     */
    protected function registerControllerProviders(): void
    {
        foreach ($this->getControllerProviderStack() as $controllerProvider) {
            $this->application->mount($controllerProvider->getUrlPrefix(), $controllerProvider);
        }
    }

    protected function getControllerProviderStack(): array
    {
        return [
            new TestControllerProvider(),
            new SprykerDebugControllerProvider(),
        ];
    }
}
