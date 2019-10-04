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
use Inviqa\Zed\SprykerDebug\Communication\Console\ConfigDumpConsole;

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

List all configuration:

```bash
$ ./vendor/bin/console debug:config
```

List all configuration that has a key containing the string "rabbit":

```bash
$ ./vendor/bin/console debug:config rabbit
+------------------------------------+---------------------------------------------------------------+--------------+
| Key                                | Value                                                         | Origin       |
+------------------------------------+---------------------------------------------------------------+--------------+
| RABBITMQ:RABBITMQ_API_HOST         | localhost                                                     | rabbitmq.php |
| RABBITMQ:RABBITMQ_API_PASSWORD     | guest                                                         | rabbitmq.php |
| RABBITMQ:RABBITMQ_API_PORT         | 16672                                                         | rabbitmq.php |
| RABBITMQ:RABBITMQ_API_USERNAME     | guest                                                         | rabbitmq.php |
| RABBITMQ:RABBITMQ_API_VIRTUAL_HOST | /                                                             | rabbitmq.php |
| RABBITMQ:RABBITMQ_CONNECTIONS      | [                                                             | rabbitmq.php |
|                                    |     {                                                         |              |
|                                    |         "RABBITMQ:RABBITMQ_CONNECTION_NAME": "GB-connection", |              |
|                                    |         "RABBITMQ:RABBITMQ_HOST": "localhost",                |              |
|                                    |         "RABBITMQ:RABBITMQ_PORT": "57720",                    |              |
|                                    |         "RABBITMQ:RABBITMQ_PASSWORD": "guest",                |              |
|                                    |         "RABBITMQ:RABBITMQ_USERNAME": "guest",                |              |
|                                    |         "RABBITMQ:RABBITMQ_VIRTUAL_HOST": "\/",               |              |
|                                    |         "RABBITMQ:RABBITMQ_STORE_NAMES": [                    |              |
|                                    |             "GB"                                              |              |
|                                    |         ],                                                    |              |
|                                    |         "RABBITMQ:RABBITMQ_DEFAULT_CONNECTION": true          |              |
|                                    |     }                                                         |              |
|                                    | ]                                                             |              |
+------------------------------------+---------------------------------------------------------------+--------------+
```
