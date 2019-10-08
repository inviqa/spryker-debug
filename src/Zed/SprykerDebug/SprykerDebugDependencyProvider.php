<?php

namespace Inviqa\Zed\SprykerDebug;

use RuntimeException;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SprykerDebugDependencyProvider extends AbstractBundleDependencyProvider
{
    public const REPORT_PLUGINS = 'REPORT_PLUGINS';

    public function provideBusinessLayerDependencies(Container $container)
    {
        $container[self::REPORT_PLUGINS] = function (Container $container) {
            return array_map(function ($className) {
                if (!is_string($className)) {
                    throw new RuntimeException(sprintf(
                        'Report plugin must be a fully qualified class name, got "%s"',
                        gettype($className)
                    ));
                }
                return new $className;
            }, $this->getEntityReportPlugins($container));
        };
    }

    protected function getEntityReportPlugins(Container $container): array
    {
        return [];
    }
}
