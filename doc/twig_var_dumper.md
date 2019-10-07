Twig Var Dumper
===============

Integrate the `symfony/var-dumper` component with Twig to get pretty dumps:

![twig var dumper](https://symfony.com/doc/current/_images/01-simple.png)

Installation
------------

### Yves

Add the `TwigVarDumpServiceProvider` to your `YvesBootstrap`:

```php
<?php

namespace Pyz\Yves\ShopApplication;

// ...
use Inviqa\Shared\SprykerDebug\Plugin\Provider\TwigVarDumpServiceProvider;

class YvesBootstrap extends SprykerYvesBootstrap
{
    protected function registerServiceProviders()
    {
        // ...
        $this->application->register(new TwigVarDumpServiceProvider());
    }
}
```

### Zed

Add the `TwigVarDumpServiceProvider` to your `ApplicationDependencyProvider`:

```php
<?php

// ...
use Inviqa\Shared\SprykerDebug\Plugin\Provider\TwigVarDumpServiceProvider;

class ApplicationDependencyProvider extends SprykerApplicationDependencyProvider
{
    protected function getServiceProviders(Container $container)
    {
        $providers = [
            // ...
            new TwigVarDumpServiceProvider()
        ]);

        // ...
    }
}
```
