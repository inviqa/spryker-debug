<?php

use InviqaSprykerDebug\Shared\Config\ArrayLoader;
use Spryker\Shared\Propel\PropelConstants;
use Spryker\Zed\Propel\PropelConfig;

assert($config instanceof ArrayObject);
$config->exchangeArray(
    array_merge(
        $config->getArrayCopy(),
        ArrayLoader::create()->load(
            json_decode(
                file_get_contents(__DIR__ . '/config.json'),
                true
            )
        )
    )
);

require __DIR__ . '/database.php';
