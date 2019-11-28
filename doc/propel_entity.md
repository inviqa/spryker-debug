Propel Entity
=============

Quickly query and display Propel entities from the CLI.

Installation
------------

Add the `PropelDumpEntityConsole` to your `ConsoleDependencyProvider`:

```php
<?php

namespace Pyz\Zed\Console;

// ...
use Inviqa\Zed\SprykerDebug\Communication\Console\PropelDumpEntityConsole;

class ConsoleDependencyProvider extends SprykerConsoleDependencyProvider
{
    // ...

    protected function getConsoleCommands(Container $container)
    {
        return [
            // ...
            new PropelDumpEntityConsole(),
        ];
    }
}
```

Usage
-----

Show product by SKU:

```
$ ./vendor/bin/console debug:propel:entity SpyProduct --by=sku:ABC-1234
```

Select all `SpyCustomer` records:

```
$ ./vendor/bin/console debug:propel:entity SpyCustomer
```

Limit records by 1:

```
$ ./vendor/bin/console debug:propel:entity PyzTestEntity --limit=1
```

Display rows as individual records:

```
$ ./vendor/bin/console debug:propel:entity PyzTestEntity --records
```


