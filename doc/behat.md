Behat Tools
===========

Dependency Injection
--------------------

Enable dependecy injection and autowiring as follows:

```
default:
  suites:
    zed:
      autowire: true
      services: MyProject\TestContainer
```

You are then able to create the `TestContainer` class referenced above in your
project, you can use any PSR-11 compatible container, but here we extend the
Spryker container:

```
<?php

namespace Inviqa\Spryker\Debug\Tests;

use Inviqa\Spryker\Debug\Shared\Test\ApplicationBuilder;
use Spryker\Service\Container\Container;
use Spryker\Shared\Application\Application;
use Spryker\Zed\Console\Communication\ConsoleBootstrap;
use Spryker\Zed\Product\Business\ProductFacade;
use Spryker\Zed\Product\Business\ProductFacadeInterface;
use Symfony\Component\Debug\Debug;

class TestContainer extends Container
{
    public function __construct()
    {
        Debug::enable();

        parent::__construct([
            Application::class => $this->initApplication(),

            MyFacade::class => function (Container $container) {
                return new MyFacade();
            },

            MyBridge::class => function (Container $container) {
                return new MyFooBridge($container->get(MyFacade::class));
            }

        ]);
    }

    private function initApplication(): Application
    {
        return ApplicationBuilder::create(__DIR__ . '/App', 'GB')
            ->build();
    }
}
```

You can then contexts which accept dependencies:

```
<?php

// ...

class MyContext implements Context
{
    // ...
    public function __construct(MyBridge $bridge)
    {
        // ...
    }
}
```

and the "bridge" class will be automatically injected (note that "bridge" is a
concept to "bridge" the gap between context and project code, but you may also
inject the Spryker facades directly if prefered).

Contexts
--------

Include contexts in your `behat.yml` configuration:

```
default:
  suites:
    zed:
      autowire: true
      services: Inviqa\Spryker\Debug\Tests\TestContainer
      paths:
        features: tests/Acceptance/Features
      filters:
        tags: "~@broken && ~@pending"
      contexts:
        - Inviqa\Spryker\Debug\Tests\Acceptance\Context\ConsoleContext

  extensions:
    Roave\BehatPsrContainer\PsrContainerExtension:
      container: 'tests/Container.php'
```

### DatabaseContext

Automatically wrap your scnearios in database transactions: this will help to
ensure that scenarios do not mutate the state of the database and cause
instability.

After adding this context, use the `@db-transaction` tag in your feature,
once for the whole feature, or per-scenario:

```
@db-transaction
Feature: Product Debug Command

  # ...
```
