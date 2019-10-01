<?php

namespace TestApp\Zed\Console;

use Spryker\Zed\Console\ConsoleDependencyProvider as SprykerConsoleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Transfer\Communication\Console\TransferGeneratorConsole;

class ConsoleDependencyProvider extends SprykerConsoleDependencyProvider
{
    protected function getConsoleCommands(Container $container)
    {
        return [
            new TransferGeneratorConsole(),
        ];
    }
}
