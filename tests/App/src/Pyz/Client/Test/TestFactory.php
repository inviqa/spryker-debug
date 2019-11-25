<?php

namespace Pyz\Client\Test;

use Pyz\Client\Test\Zed\TestStub;
use Spryker\Client\Kernel\AbstractFactory;

class TestFactory extends AbstractFactory
{
    public function createStub(): TestStub
    {
        return new TestStub($this->getProvidedDependency(TestDependencyProvider::SERVICE_ZED));
    }
}
