Config Dump
===========

Inspect the Spryker configuration.

This command will:

- Show all configuration keys values for the environment.
- Show the file in which the configuration value was created / modified.
- Allow you to filter by key

Installation
------------

Add the `ConfigDumpConsole` to your `ConsoleDependencyProvider`:

```php
<?php

namespace Pyz\Zed\Console;

// ...
use Inviqa\SprykerDebug\Zed\Communication\Console\ConfigDumpConsole;

class ConsoleDependencyProvider extends SprykerConsoleDependencyProvider
{
    // ...

    protected function getConsoleCommands(Container $container)
    {
        return [
            // ...
            new ConfigDumpConsole(),
        ];
    }
}
```

Usage
-----

```bash
$ ./vendor/bin/console debug:config
```

Filter keys:

```bash
$ ./vendor/bin/console debug:config DB
```
