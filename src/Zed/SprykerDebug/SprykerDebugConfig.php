<?php

namespace Inviqa\Zed\SprykerDebug;

use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Shared\Config\Config;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class SprykerDebugConfig extends AbstractBundleConfig
{
    public function getYvesApiBaseUrl(): string
    {
        if (Config::hasKey(SprykerDebugConstants::API_BASE_URL)) {
            return Config::get(SprykerDebugConstants::API_BASE_URL);
        }

        return Config::get(Config::get(ApplicationConstants::YVES_SSL_ENABLED) ?
            ApplicationConstants::BASE_URL_SSL_YVES :
            ApplicationConstants::BASE_URL_YVES) ?? '';
    }
}
