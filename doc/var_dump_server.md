Var Dump Server
===============

You can use `var_dump` or `dump()` to inspect variables in the browser, but
this is actually a terrible idea as often it will corrupt the output and leave
you dazed and confused.

The Symfony [var dump
server](https://symfony.com/doc/current/components/var_dumper.html#the-dump-server)
provides you with an alternative. Instead of dumping to the output, it will
dump to a CLI application which you have running.

![recording](https://user-images.githubusercontent.com/530801/66316960-8dd7f600-e910-11e9-822c-de8c0e84ab45.gif)

Installation
------------

Add the following to your `config_local.php`:

```php
VarDumper::setHandler(function ($var) {
    $cloner = new VarCloner();
    (new ServerDumper(
        '127.0.0.1:9912',
        new CliDumper(),
        [
            'cli' => new CliContextProvider(),
            'source' => new SourceContextProvider(),
        ]
    ))->dump($cloner->cloneVar($var));
});
```

- `127.0.0.1:9912` is the address the server is listening on by default.
- We specify context providers: These tell us which file a debug message came
  from.

Usage
-----

Run the server:

```
$ ./vendor/bin/var-dump-server
```

Use `dump()` in your code:

```php
<?php

// ...

dump($something);
```

**TIP!**: The in Twig ``{{ dump(something) }}`` will not send information to the server -
Use `{% dump(something) %}` instead.

Running in Docker
-----------------

It is likely that the container running the web worker (php-fpm) will not be
able to see the var-dump server running in a different container.

You may need to start a var dump server for each container (e.g. console and
web):

Example:

```
# can see dumps from the web server
$ docker-compose exec web ./vendor/bin/var-dump-server
```

```
# can see dumps from the CLI
$ docker-compose exec cli ./vendor/bin/var-dump-server
```
