<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ShopApplication;

use Inviqa\Shared\SprykerDebug\Plugin\Application\GuzzleProfilerApplicationPlugin;
use Inviqa\Shared\SprykerDebug\Plugin\Application\TwigVarDumpApplicationPlugin;
use Inviqa\Yves\SprykerDebug\Plugin\SprykerDebugControllerProvider;
use Pyz\Yves\Test\Plugin\Provider\TestControllerProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TwigServiceProvider;
use SprykerShop\Yves\WebProfilerWidget\Plugin\Application\WebProfilerApplicationPlugin;
use SprykerShop\Yves\WebProfilerWidget\Plugin\ServiceProvider\WebProfilerWidgetServiceProvider;
use Spryker\Glue\EventDispatcher\Plugin\Application\EventDispatcherApplicationPlugin;
use Spryker\Shared\Application\Business\Routing\SilexRouter;
use Spryker\Shared\Application\ServiceProvider\RoutingServiceProvider;
use Spryker\Shared\ErrorHandler\Plugin\ServiceProvider\WhoopsErrorHandlerServiceProvider;
use SprykerShop\Yves\ShopApplication\YvesBootstrap as SprykerYvesBootstrap;
use Spryker\Yves\ErrorHandler\Plugin\Application\ErrorHandlerApplicationPlugin;
use Spryker\Yves\Http\Plugin\Application\HttpApplicationPlugin;
use Spryker\Yves\Http\Plugin\Http\InlineRendererFragmentHandlerPlugin;
use Spryker\Yves\Router\Plugin\Application\RouterApplicationPlugin;
use Spryker\Yves\Twig\Plugin\Application\TwigApplicationPlugin;

class YvesBootstrap extends SprykerYvesBootstrap
{
    protected function registerServiceProviders(): void
    {
        $this->application['debug'] = true;
        $this->application->register(new ServiceControllerServiceProvider());
        $this->application->register(new WhoopsErrorHandlerServiceProvider());
        $this->application->register(new HttpFragmentServiceProvider());
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

    protected function getApplicationPlugins(): array
    {
        return [
            new TwigApplicationPlugin(),
            new TwigVarDumpApplicationPlugin(),
            new EventDispatcherApplicationPlugin(),
            new WebProfilerApplicationPlugin(),
            new RouterApplicationPlugin(),
            new ErrorHandlerApplicationPlugin(),
            new HttpApplicationPlugin(),
            new GuzzleProfilerApplicationPlugin(),
        ];
    }
}
