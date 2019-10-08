<?php

namespace Inviqa\Yves\SprykerDebug\Plugin;

use Silex\Application;
use Spryker\Yves\Application\Plugin\Provider\YvesControllerProvider;

class SprykerDebugControllerProvider extends YvesControllerProvider
{
    /**
     * {@inheritDoc}
     */
    protected function defineControllers(Application $app)
    {
        $this->createController('/spryker-debug/routes', 'spryker-debug-routes', 'SprykerDebug', 'RouteApi');
    }
}
