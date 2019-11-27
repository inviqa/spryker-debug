<?php

namespace Pyz\Zed\Console;

use Inviqa\Zed\SprykerDebug\Communication\Console\DebugConfigConsole;
use Inviqa\Zed\SprykerDebug\Communication\Console\DatabaseShellConsole;
use Inviqa\Zed\SprykerDebug\Communication\Console\DebugQueuesConsole;
use Inviqa\Zed\SprykerDebug\Communication\Console\DebugQueuesPeekConsole;
use Inviqa\Zed\SprykerDebug\Communication\Console\PropelDumpMetadataConsole;
use Inviqa\Zed\SprykerDebug\Communication\Console\RedisShellConsole;
use Inviqa\Zed\SprykerDebug\Communication\Console\DebugRoutesConsole;
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
use Spryker\Zed\Queue\Communication\Console\QueueDumpConsole;
use Spryker\Zed\Queue\Communication\Console\QueueTaskConsole;
use Spryker\Zed\Queue\Communication\Console\QueueWorkerConsole;
use Spryker\Zed\RabbitMq\Communication\Console\DeleteAllQueuesConsole;
use Spryker\Zed\RabbitMq\Communication\Console\PurgeAllQueuesConsole;
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
            new QueueDumpConsole(),
            new QueueTaskConsole(),
            new QueueWorkerConsole(),
            new PurgeAllQueuesConsole(),
            new DeleteAllQueuesConsole(),

            new DatabaseShellConsole(),
            new RedisShellConsole(),
            new DebugConfigConsole(),
            new DebugQueuesConsole(),
            new DebugQueuesPeekConsole(),
            new DebugRoutesConsole(),
            new PropelDumpMetadataConsole(),
        ];
    }
}
