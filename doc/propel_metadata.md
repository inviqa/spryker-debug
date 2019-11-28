Propel Metadata
===============

Inspect propel metadata including any configured behaviors.

Installation
------------

Add the `PropelDumpMetadataConsole` to your `ConsoleDependencyProvider`:

```php
<?php

namespace Pyz\Zed\Console;

// ...
use Inviqa\Zed\SprykerDebug\Communication\Console\PropelDumpMetadataConsole;

class ConsoleDependencyProvider extends SprykerConsoleDependencyProvider
{
    // ...

    protected function getConsoleCommands(Container $container)
    {
        return [
            // ...
            new PropelDumpMetadataConsole(),
        ];
    }
}
```

Usage
-----

Select from list of tables

```bash
$ ./vendor/bin/console debug:propel:metadata
```

Show metadata for a specific entity by table name:

```bash
$ ./vendor/bin/console debug:propel:metadata spy_customer
```

Show metadata for a specific entity by PHP name:

```bash
$ ./vendor/bin/console debug:propel:metadata SpyCustomer

```

Information looks something like:

```
SpyCustomer
===========

General
-------

 ------------- ---------------------------------------------
  class         \Orm\Zed\Customer\Persistence\SpyCustomer
  collection    \Propel\Runtime\Collection\ObjectCollection
  table         spy_customer
  primaryKeys   {"id_customer":{}}
 ------------- ---------------------------------------------

Schema
------

+--------------------------+-----------+---------+------+
| column                   | type      | default | size |
+--------------------------+-----------+---------+------+
| id_customer              | INTEGER   |         |      |
| fk_locale                | INTEGER   |         |      |
| customer_reference       | VARCHAR   |         | 255  |
| email                    | VARCHAR   |         | 255  |
| salutation               | ENUM      |         |      |
| first_name               | VARCHAR   |         | 100  |
| last_name                | VARCHAR   |         | 100  |
| company                  | VARCHAR   |         | 100  |
| gender                   | ENUM      |         |      |
| date_of_birth            | DATE      |         |      |
| password                 | VARCHAR   |         | 255  |
| restore_password_key     | VARCHAR   |         | 150  |
| restore_password_date    | TIMESTAMP |         |      |
| registered               | DATE      |         |      |
| registration_key         | VARCHAR   |         | 150  |
| default_billing_address  | INTEGER   |         |      |
| default_shipping_address | INTEGER   |         |      |
| phone                    | VARCHAR   |         | 255  |
| anonymized_at            | TIMESTAMP |         |      |
| created_at               | TIMESTAMP |         |      |
| updated_at               | TIMESTAMP |         |      |
+--------------------------+-----------+---------+------+

Behaviors
---------

 --------------- ------------------------------------
  timestampable   {
                      "create_column": "created_at",
                      "update_column": "updated_at",
                      "disable_created_at": "false",
                      "disable_updated_at": "false"
                  }
 --------------- ------------------------------------

Foreign Keys
------------

 fk_locale => spy_locale.id_locale
 default_billing_address => spy_customer_address.id_customer_address
 default_shipping_address => spy_customer_address.id_customer_address

Relations
---------
 default_billing_address * -> 1 spy_customer_address
 default_shipping_address * -> 1 spy_customer_address
 fk_locale * -> 1 spy_locale
 fk_customer 1 -> * spy_customer
```
