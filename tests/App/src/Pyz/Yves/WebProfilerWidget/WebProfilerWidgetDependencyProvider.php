<?php

namespace Pyz\Yves\WebProfilerWidget;

use SprykerShop\Yves\WebProfilerWidget\Plugin\WebProfiler\WebProfilerAjaxDataCollectorPlugin;
use SprykerShop\Yves\WebProfilerWidget\Plugin\WebProfiler\WebProfilerConfigDataCollectorPlugin;
use SprykerShop\Yves\WebProfilerWidget\Plugin\WebProfiler\WebProfilerEventsDataCollectorPlugin;
use SprykerShop\Yves\WebProfilerWidget\Plugin\WebProfiler\WebProfilerExceptionDataCollectorPlugin;
use SprykerShop\Yves\WebProfilerWidget\Plugin\WebProfiler\WebProfilerLoggerDataCollectorPlugin;
use SprykerShop\Yves\WebProfilerWidget\Plugin\WebProfiler\WebProfilerMemoryDataCollectorPlugin;
use SprykerShop\Yves\WebProfilerWidget\Plugin\WebProfiler\WebProfilerRouterDataCollectorPlugin;
use SprykerShop\Yves\WebProfilerWidget\Plugin\WebProfiler\WebProfilerTimeDataCollectorPlugin;
use SprykerShop\Yves\WebProfilerWidget\Plugin\WebProfiler\WebProfilerTwigDataCollectorPlugin;
use SprykerShop\Yves\WebProfilerWidget\WebProfilerWidgetDependencyProvider as SprykerWebProfilerWidgetDependencyProvider;
use Spryker\Shared\WebProfiler\DataCollector\RequestDataCollector;
use Spryker\Shared\WebProfiler\Plugin\ServiceProvider\WebProfilerServiceProvider;
use Spryker\Yves\Config\Plugin\ServiceProvider\ConfigProfilerServiceProvider;
use Spryker\Zed\WebProfiler\Communication\Plugin\WebProfiler\WebProfilerRequestDataCollectorPlugin;

class WebProfilerWidgetDependencyProvider extends SprykerWebProfilerWidgetDependencyProvider
{
    public function getDataCollectorPlugins()
    {
        return [
            new WebProfilerRequestDataCollectorPlugin(),
            new WebProfilerAjaxDataCollectorPlugin(),
            new WebProfilerExceptionDataCollectorPlugin(),
            new WebProfilerLoggerDataCollectorPlugin(),
            new WebProfilerConfigDataCollectorPlugin(),
            new WebProfilerEventsDataCollectorPlugin(),
            new WebProfilerRouterDataCollectorPlugin(),
            new WebProfilerTimeDataCollectorPlugin(),
            new WebProfilerTwigDataCollectorPlugin(),
            new WebProfilerMemoryDataCollectorPlugin(),
        ];
    }

    /**
     * @return array
     */
    protected function getWebProfilerPlugins()
    {
        return [
        ];
    }
}
