<?php

namespace Pyz\Zed\SprykerDebug;

use Inviqa\Zed\SprykerDebug\Communication\Plugin\ProductEntityReportPlugin;
use Inviqa\Zed\SprykerDebug\SprykerDebugDependencyProvider as InviqaSprykerDebugDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SprykerDebugDependencyProvider extends InviqaSprykerDebugDependencyProvider
{
    protected function getEntityReportPlugins(Container $container): array
    {
        $workspaceReportPath = __DIR__ . '/../../../../../Workspace/entity_report_plugins.php';

        if (file_exists($workspaceReportPath)) {
            return require $workspaceReportPath;
        }

        return [
        ];
    }
}
