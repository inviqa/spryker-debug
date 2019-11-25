Queue Peek
==========

Inspect messages in the queue.

Installation
------------

Add the `DebugQueuesPeekConsole` to your `ConsoleDependencyProvider`:

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
            new DebugQueuesPeekConsole(),
        ];
    }
}
```

Usage
-----

Show message from the `foobar` queue:

```bash
$ ./vendor/bin/console debug:queues:peek foobar
{"hello": "goodbye"}
```

Format a JSON message:

```bash
$ ./vendor/bin/console debug:queues:peek foobar --json
{
  "hello": "goodbye"
}
```

Specify a vhost:

```bash
$ ./vendor/bin/console debug:queues foobar --vhost=/de-spryker
```
