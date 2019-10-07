<?php

namespace Pyz\Application\Communication;

use Psr\Container\ContainerInterface;
use Spryker\Zed\Application\Communication\ZedBootstrap as SprykerZedBootstrap;

class YvesBootstrap extends SprykerZedBootstrap implements TestBootstrap
{
    public function container(): ContainerInterface
    {
        $this->boot();
        return $this->application;
    }
}
