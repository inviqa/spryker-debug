<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Model\Config;

use ArrayObject;
use Spryker\Shared\Config\Config;

class ConfigTypeExtractingConfig extends Config
{
    private static $types;

    public function __invoke(): array
    {
        self::init();

        return self::$types;
    }

    protected static function buildConfig($type, ArrayObject $config)
    {
        $trackingArrayObject = new KeyTrackingArrayObject($config->getArrayCopy());
        parent::buildConfig($type, $trackingArrayObject);

        foreach ($trackingArrayObject->keyToFileMap() as $key => $declaringFile) {
            self::$types[$key] = $declaringFile;
        }

        foreach ($trackingArrayObject as $key => $value) {
            $config[$key] = $value;
        }

        return $config;
    }
}
