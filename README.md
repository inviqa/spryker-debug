Spryker Debug
=============

[![Build Status](https://travis-ci.org/inviqa/spryker-debug.svg?branch=master)](https://travis-ci.org/inviqa/spryker-debug)
[![License](https://poser.pugx.org/inviqa/spryker-debug/license)](https://packagist.org/packages/inviqa/spryker-debug)

Collection of debug and development tools for Spryker:

Installation
------------

Require the package with composer:

```
$ composer require inviqa/spryker-debug
```

Add the `Inviqa` namespace to the `CORE_NAMESPACES` key in your `config/Shared/config_default.php` file:

```php
$config[KernelConstants::CORE_NAMESPACES] = [
    // ...
    'Inviqa',
];
```

Each feature needs to be enabled individually. Instructions provided in the
documentation.

Features
--------

Follow the link for documentation:

### Console Commands

- [Config Dump](doc/config_dump.md): Inpsect configuration.
- [Route Debug](doc/route_debug.md): Inspect routes from Yves
- [Queue Overview](doc/queue_overview.md): Inspect queue statuses.
- [Database Shell](doc/database_shell.md): Launch a postgres shell.
- [Redis Shell](doc/redis_shell.md): Launch a Redis shell.

### Integrations

- [Twig Var Dumper](doc/twig_var_dumper.md): Pretty `{{ dump() }}` in Twig.
- [Var Dump Server](doc/var_dump_server.md): Send `dump()` messages to the command line.

Developing
----------

Run the tests:

```
composer integrate
```
