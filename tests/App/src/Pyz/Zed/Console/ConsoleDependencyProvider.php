<?php

namespace Pyz\Zed\Console;

use InviqaSprykerDebug\Zed\Communication\Console\DatabaseShellConsole;
use InviqaSprykerDebug\Zed\Communication\Console\RedisShellConsole;
use Spryker\Zed\Console\ConsoleDependencyProvider as SprykerConsoleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Propel\Communication\Console\BuildModelConsole;
use Spryker\Zed\Propel\Communication\Console\BuildSqlConsole;
use Spryker\Zed\Propel\Communication\Console\ConvertConfigConsole;
use Spryker\Zed\Propel\Communication\Console\DiffConsole;
use Spryker\Zed\Propel\Communication\Console\InsertSqlConsole;
use Spryker\Zed\Propel\Communication\Console\MigrateConsole;
use Spryker\Zed\Propel\Communication\Console\PropelInstallConsole;
use Spryker\Zed\Propel\Communication\Console\SchemaCopyConsole;
use Spryker\Zed\Transfer\Communication\Console\TransferGeneratorConsole;

class ConsoleDependencyProvider extends SprykerConsoleDependencyProvider
{
    protected function getConsoleCommands(Container $container)
    {
        return [
            new TransferGeneratorConsole(),
            new PropelInstallConsole(),
            new BuildModelConsole(),
            new BuildSqlConsole(),
            new ConvertConfigConsole(),
            new DiffConsole(),
            new InsertSqlConsole(),
            new MigrateConsole(),
            new SchemaCopyConsole(),

            new DatabaseShellConsole(),
            new RedisShellConsole(),
        ];
    }
}
