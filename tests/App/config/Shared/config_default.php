<?php

use Inviqa\Spryker\Debug\Shared\Config\ArrayLoader;

assert($config instanceof ArrayObject);
$config = $config->exchangeArray(
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
