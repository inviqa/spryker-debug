<?php

namespace Pyz\Client\Test;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class TestDependencyProvider extends AbstractDependencyProvider
{
    public const SERVICE_ZED = 'zed service';

    public function provideServiceLayerDependencies(Container $container)
    {
        $this->addZedRequestClient($container);
    }

    protected function addZedRequestClient(Container $container)
    {
        $container[static::SERVICE_ZED] = function (Container $container) {
            return $container->getLocator()->zedRequest()->client();
        };

        return $container;
    }
}
