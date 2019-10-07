<?php

namespace Pyz\Zed\Application\Communication;

use Inviqa\SprykerDebug\Tests\Support\TestBootstrap;
use Psr\Container\ContainerInterface;
use Spryker\Zed\Application\Communication\ZedBootstrap as SprykerZedBootstrap;

class ZedBootstrap extends SprykerZedBootstrap implements TestBootstrap
{
    public function bootContainer(): ContainerInterface
    {
        $this->boot();
        return $this->application;
    }
}
