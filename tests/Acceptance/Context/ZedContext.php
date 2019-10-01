<?php

namespace Inviqa\Spryker\Debug\Tests\Acceptance\Context;

use Behat\Behat\Context\Context;
use Spryker\Zed\Application\Communication\ZedBootstrap;

class ZedContext implements Context
{
    /**
     * @BeforeSuite
     */
    public static function initializeZed()
    {
        $bootstrap = new ZedBootstrap();
        $bootstrap->boot();
    }
}
