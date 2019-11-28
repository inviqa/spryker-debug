<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Model\Propel;

use ArrayIterator;
use Iterator;
use IteratorAggregate;

class Tables implements IteratorAggregate
{
    private $tables;

    public function __construct(array $tables)
    {
        foreach ($tables as $table) {
            $this->add($table);
        }
    }

    private function add($table): void
    {
        $this->tables[] = $table;
    }

    public function getIterator(): Iterator
    {
        return new ArrayIterator($this->tables);
    }

    public function toArray(): array
    {
        return $this->tables;
    }
}
