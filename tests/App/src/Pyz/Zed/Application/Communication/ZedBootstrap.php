<?php

namespace Pyz\Zed\Application\Communication;

use Inviqa\Shared\SprykerDebug\Plugin\Application\TwigVarDumpApplicationPlugin;
use Inviqa\SprykerDebug\Tests\Support\TestBootstrap;
use Psr\Container\ContainerInterface;
use Spryker\Zed\Application\Communication\Bootstrap\ZedBootstrap as SprykerZedBootstrap;
use Spryker\Zed\EventDispatcher\Communication\Plugin\Application\EventDispatcherApplicationPlugin;
use Spryker\Zed\Http\Communication\Plugin\Application\HttpApplicationPlugin;

class ZedBootstrap extends SprykerZedBootstrap implements TestBootstrap
{
    public function bootContainer(): ContainerInterface
    {
        $this->boot();

        return $this->getContainer();
    }

    protected function getApplicationPlugins(): array
    {
        return [
            new HttpApplicationPlugin(),
            new EventDispatcherApplicationPlugin(),
            new TwigVarDumpApplicationPlugin(),
        ];
    }
}
