<?php

namespace Pyz\Zed\Application\Communication;

use Inviqa\SprykerDebug\Tests\Support\TestBootstrap;
use Psr\Container\ContainerInterface;
use Spryker\Zed\Application\Communication\ZedBootstrap as SprykerZedBootstrap;
use Spryker\Zed\EventDispatcher\Communication\Plugin\Application\EventDispatcherApplicationPlugin;
use Spryker\Zed\Http\Communication\Plugin\Application\HttpApplicationPlugin;
use Spryker\Zed\Router\Communication\Plugin\Application\RouterApplicationPlugin;

class ZedBootstrap extends SprykerZedBootstrap implements TestBootstrap
{
    public function bootContainer(): ContainerInterface
    {
        $this->boot();

        return $this->application;
    }

    protected function getApplicationPlugins(): array
    {
        return [
            new HttpApplicationPlugin(),
            new EventDispatcherApplicationPlugin(),
        ];
    }
}
