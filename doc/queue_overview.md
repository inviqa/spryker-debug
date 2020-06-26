Queue Overview
==============

Shows the overview of queues.

This command calls the RabbitMQ API and retrieves all the queue details,
similar to those shown in the Web interface.

Installation
------------

Add the `DebugQueuesConsole` to your `ConsoleDependencyProvider`:

```php
<?php

namespace Pyz\Zed\Console;

// ...
use Inviqa\Zed\SprykerDebug\Communication\Console\DebugQueuesConsole;

class ConsoleDependencyProvider extends SprykerConsoleDependencyProvider
{
    // ...

    protected function getConsoleCommands(Container $container)
    {
        return [
            // ...
            new DebugQueuesConsole(),
        ];
    }
}
```

Usage
-----

List all queues:

```bash
$ ./vendor/bin/console debug:queues
+--------------------------------+---------+-------+---------+-------+
| name                           | state   | ready | unacked | total |
+--------------------------------+---------+-------+---------+-------+
| foobar                         | running | 0     | 0       | 0     |
+--------------------------------+---------+-------+---------+-------+
```

List all queues containing the string "foobar":

```bash
$ ./vendor/bin/console debug:queues foobar
```

List all queues for a specific vhost:

```bash
$ ./vendor/bin/console debug:queues --vhost=de
```

List all non-empty queues:

```bash
$ ./vendor/bin/console debug:queues --non-empty
```

Notes
-----

You can also use the `rabbitmqctl` to retrive queues and do lots more, but this
may not be installed on the applicatoin server.
