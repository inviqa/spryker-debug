Route Debug
===========

Shows a detailed list of all routes in your YVES application.

![foo](https://user-images.githubusercontent.com/530801/66388319-bcf87100-e9bd-11e9-8a70-548619056eaa.png)

**NOTE**: This command needs to communicate with Yves over HTTP in order to
          retrieve the registered routes, as the console is a separate application and
          has no in-process access to Yves.

Installation
------------

Ensure that you have configured the [debug api](debug_api.md).

Add the `RouteDebugConsole` to your `ConsoleDependencyProvider`:

```php
<?php

namespace Pyz\Zed\Console;

// ...
use Inviqa\Zed\SprykerDebug\Communication\Console\RouteDebugConsole;

class ConsoleDependencyProvider extends SprykerConsoleDependencyProvider
{
    // ...

    protected function getConsoleCommands(Container $container)
    {
        return [
            // ...
            new RouteDebugConsole(),
        ];
    }
}
```

Usage
-----

List all routes:

```bash
$ ./vendor/bin/console debug:routes
```

Show defaults (including controller), requirements and condition:

```bash
$ ./vendor/bin/console debug:routes --defaults --requirements --condition
```
