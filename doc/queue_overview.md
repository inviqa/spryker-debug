Queue Overview
==============

Shows the overview of queues.

This command calls the RabbitMQ API and retrieves all the queue details,
similar to those shown in the Web interface.

Installation
------------

Add the `QueuesOverviewConsole` to your `ConsoleDependencyProvider`:

```php
<?php

namespace Pyz\Zed\Console;

// ...
use Inviqa\Zed\SprykerDebug\Communication\Console\QueuesOverviewConsole;

class ConsoleDependencyProvider extends SprykerConsoleDependencyProvider
{
    // ...

    protected function getConsoleCommands(Container $container)
    {
        return [
            // ...
            new QueuesOverviewConsole(),
        ];
    }
}
```

Usage
-----

List all queues:

```bash
$ ./vendor/bin/debug:queues
+--------------------------------+---------+-------+---------+-------+
| name                           | state   | ready | unacked | total |
+--------------------------------+---------+-------+---------+-------+
| foobar                         | running | 0     | 0       | 0     |
+--------------------------------+---------+-------+---------+-------+
```

Notes
-----

You can also use the `rabbitmqctl` to retrive queues and do lots more, but this
may not be installed on the applicatoin server.
