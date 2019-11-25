Guzzle Profiler
===============

Profile guzzle requests in the Symfony Profiler.

Installation
------------

Add the `GuzzleProfilerApplicationPlugin` to your
`ShopApplicationDependencyProvider`:

```php
<?php

namespace Pyz\Zed\Console;

// ...
use Inviqa\Shared\SprykerDebug\Plugin\Application\GuzzleProfilerApplicationPlugin;

class ShopApplicationDependencyProvider extends SprykerShopApplicationDependencyProvider
{
    protected function getApplicationPlugins(): array
    {
        return [
            // ...
            new GuzzleProfilerApplicationPlugin(),
        ];
    }
}
```

**WARNING**: This should probably not be enabled in production. Use at your
             own risk.

Usage
-----

The profiler should "just work" whenever a guzzle request is made. Each guzzle
request will be recorded by the Symfony Stopwatch.

![Untitled](https://user-images.githubusercontent.com/530801/69557105-f13fe500-0f9d-11ea-93c4-9d0d41986e5c.png)

