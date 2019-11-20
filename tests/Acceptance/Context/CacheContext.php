<?php

namespace Inviqa\SprykerDebug\Tests\Acceptance\Context;

use Behat\Behat\Context\Context;
use Symfony\Component\Filesystem\Filesystem;

class CacheContext implements Context
{
    /**
     * @BeforeScenario
     */
    public function clearCache()
    {
        $filesystem = new Filesystem();
        $filesystem->remove(__DIR__ . '/../../App/data/cache');
    }
}
