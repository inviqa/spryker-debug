Debug API
=========

The Debug API is a simple web service to retrive debug information from Yves.

Installation
------------

Register `SprykerDebugControllerProvider` in `YvesBootstrap`:

```
<?php

namespace Pyz\Yves\ShopApplication;

// ...
use Inviqa\Yves\SprykerDebug\Plugin\SprykerDebugControllerProvider;

class YvesBootstrap extends SprykerYvesBootstrap
{
    protected function registerControllerProviders()
    {
        // ...

        if (Environment::isDevelopment()) {
          $controllerProviders = array_merge($controllerProviders, $this->getDevelopmentControllerProviderStack());
        }

        // ...
    }

    private function getDevelopmentControllerProviderStack()
    {
        return [
            new SprykerDebugControllerProvider(),
        ];
    }
}
```

**IMPORTANT**: Do not expose the debug API on production.

Configuration
-------------

By default the API endpoint will try and use the configured `BASE_URL_YVES`
key. You can override this by specifying `SPRYKER_DEBUG_API_BASE_URL` in your
`config_local.php` (for example):

```php
<?php

use Inviqa\Zed\SprykerDebug\SprykerDebugConstants;

$config[SprykerDebugConstants::API_BASE_URL] = 'https://yves.localhost';
```

Endpoints
---------

- `/spryker-debug/routes`: Returns a JSON list of all registered routes.
