<?php

namespace Pyz\Yves\Test\Plugin\Provider;

use Silex\Application;
use Spryker\Yves\Application\Plugin\Provider\ControllerProviderInterface;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\AbstractYvesControllerProvider;

class TestControllerProvider extends AbstractYvesControllerProvider implements ControllerProviderInterface
{
    /**
     * {@inheritDoc}
     */
    protected function defineControllers(Application $app)
    {
        $this->createController('/', 'home', 'Test', 'Index');
    }
}
