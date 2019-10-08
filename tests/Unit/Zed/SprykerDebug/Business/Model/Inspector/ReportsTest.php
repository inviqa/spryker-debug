<?php

namespace Inviqa\SprykerDebug\Tests\Unit\Zed\SprykerDebug\Business\Model\Inspector;

use Inviqa\Zed\SprykerDebug\Business\Model\Inspector\Report;
use Inviqa\Zed\SprykerDebug\Business\Model\Inspector\Reports;
use PHPUnit\Framework\TestCase;
use stdClass;

class ReportsTest extends TestCase
{
    public function testIsIterableAndCountable()
    {
        $report1 = $this->prophesize(Report::class);
        $report2 = $this->prophesize(Report::class);
        $reports = new Reports([
            $report1->reveal(),
            $report2->reveal(),
        ]);
        $this->assertCount(2, $reports);
        $reports = iterator_to_array($reports);
        $this->assertCount(2, $reports);
    }

    public function testReturnsReportsForObject()
    {
        $object = new stdClass();
        $report1 = $this->prophesize(Report::class);
        $report2 = $this->prophesize(Report::class);
        $reports = new Reports([
            $report1->reveal(),
            $report2->reveal(),
        ]);
        $report1->accepts($object)->willReturn(true);
        $report2->accepts($object)->willReturn(false);

        $reports = $reports->reportsFor($object);

        $this->assertCount(1, $reports);
    }
}
