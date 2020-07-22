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

Configuration
------------

Make sure that both Yves and Zed have the "debug" option enabled for Twig, otherwise the Twig\Environment will skip the dump-function.

```php
// config/Shared/config_default-%env%.php

$config[TwigConstants::YVES_TWIG_OPTIONS] = [
    ...
    'debug' => true
];

...

$config[TwigConstants::ZED_TWIG_OPTIONS] = [
    ...
    'debug' => true
];
```
