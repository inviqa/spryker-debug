Redis Shell
===========

Attempts to launch the Redis shell using the current project _storage_
configuration.

Installation
------------

Add the `RedisShellConsole` to your `ConsoleDependencyProvider`:

```php
<?php

namespace Pyz\Zed\Console;

// ...
use Inviqa\Zed\SprykerDebug\Communication\Console\RedisShellConsole;

class ConsoleDependencyProvider extends SprykerConsoleDependencyProvider
{
    // ...

    protected function getConsoleCommands(Container $container)
    {
        return [
            // ...
            new RedisShellConsole(),
        ];
    }
}
```

Usage
-----

Launch the redis shell:

```bash
$ ./vendor/bin/console debug:redis:shell
```
