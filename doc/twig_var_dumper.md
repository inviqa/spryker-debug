Twig Var Dumper
===============

Integrate the `symfony/var-dumper` component with Twig to get pretty dumps:

![twig var dumper](https://symfony.com/doc/current/_images/01-simple.png)

Installation
------------

### Yves

Add the `TwigVarDumpServiceProvider` to your `ShopApplicationDependencyProvider` (you may need to create the method below if it does not exist):

```php
<?php

namespace Pyz\Yves\ShopApplication;

// ...
use Inviqa\Shared\SprykerDebug\Plugin\Provider\TwigVarDumpServiceProvider;

class ShopApplicationDependencyProvider extends SprykerShopApplicationDependencyProvider
{
    protected function getApplicationPlugins(): array
    {
        return [
            // ...
            new TwigVarDumpApplicationPlugin(),
        ];
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
    protected function getApplicationPlugins(Container $container)
    {
        return [
            // ...
            new TwigVarDumpApplicationPlugin()
        ]);
    }
}
```
