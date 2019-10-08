<?php

namespace Inviqa\Zed\SprykerDebug\Business;

use Inviqa\Zed\SprykerDebug\Business\Model\Inspector\ReportGenerator;
use Inviqa\Zed\SprykerDebug\Business\Model\Inspector\Reports;
use Inviqa\Zed\SprykerDebug\SprykerDebugDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class SprykerDebugBusinessFactory extends AbstractBusinessFactory
{
    public function createReportGenerator(): ReportGenerator
    {
        return new ReportGenerator(new Reports($this->getReportGeneratorPlugins()));
    }

    private function getReportGeneratorPlugins()
    {
        return $this->getProvidedDependency(SprykerDebugDependencyProvider::REPORT_PLUGINS);
    }
}
