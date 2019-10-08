<?php

namespace Inviqa\Zed\SprykerDebug\Business\Model\Inspector;

use ArrayIterator;
use IteratorAggregate;

class Reports implements IteratorAggregate
{
    /**
     * @var Report[]
     */
    private $reports;

    public function __construct(array $reports)
    {
        $this->reports = array_map(function (Report $report) {
            return $report;
        }, $reports);
    }

    public function reportsFor(object $entity): self
    {
        return new self(array_filter($this->reports, function (Report $report) use ($entity) {
            return $report->accepts($entity);
        }));
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator()
    {
        return new ArrayIterator($this->reports);
    }
}
