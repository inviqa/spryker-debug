<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Model\Propel;

use ArrayIterator;
use Iterator;
use IteratorAggregate;
use Propel\Runtime\Map\Exception\TableNotFoundException;
use Propel\Runtime\Map\TableMap;

class Tables implements IteratorAggregate
{
    /**
     * @var array
     */
    private $tables;

    public function __construct(array $tables)
    {
        foreach ($tables as $table) {
            $this->add($table);
        }
    }

    private function add(TableMap $table): void
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

    public function get(string $phpOrTableName): TableMap
    {
        foreach ($this->tables as $table) {
            if ($table->getName() === $phpOrTableName || $table->getPhpName() === $phpOrTableName) {
                return $table;
            }
        }

        throw new TableNotFoundException(sprintf(
            'Could not find table map "%s" (using either PHP or table name)',
            $phpOrTableName,
        ));
    }
}
