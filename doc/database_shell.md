Database Shell
==============

Attempts to launch the Postgres shell using the current project database
configuration.

Installation
------------

Add the `DatabaseShellConsole` to your `ConsoleDependencyProvider`:

```php
<?php

namespace Pyz\Zed\Console;

// ...
use Inviqa\Zed\SprykerDebug\Communication\Console\DatabaseShellConsole;

class ConsoleDependencyProvider extends SprykerConsoleDependencyProvider
{
    // ...

    protected function getConsoleCommands(Container $container)
    {
        return [
            // ...
            new DatabaseShellConsole(),
        ];
    }
}
```

Usage
-----

Connect to the `psql` shell:

```bash
$ ./vendor/bin/debug:database:shell
```

Note that the `pgcli` shell will need to be available.
