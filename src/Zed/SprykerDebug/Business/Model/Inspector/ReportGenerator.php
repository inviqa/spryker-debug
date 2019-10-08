<?php

namespace Inviqa\Zed\SprykerDebug\Business\Model\Inspector;

use Generator;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Propel;
use RuntimeException;
use Spryker\Zed\PropelOrm\Business\Builder\QueryBuilder;

class ReportGenerator
{
    /**
     * @var Reports
     */
    private $reports;

    public function __construct(Reports $reports)
    {
        $this->reports = $reports;
    }

    /**
     * @return Generator<string>
     */
    public function generateFor(string $tableName, array $ids): Generator
    {
        $className = $this->resolveClassName($tableName);
        $entities = $this->findEntities($tableName, $ids);

        foreach ($entities as $entity) {
            $reports = $this->reports->reportsFor($entity);
            foreach ($reports as $report) {
                yield $report->render($entity);
            }
        }
    }

    private function findEntities(string $className, array $ids): array
    {
        $queryClassName = $className . 'Query';

        if (!class_exists($queryClassName)) {
            throw new RuntimeException(sprintf(
                'Class name by propel "%s" does not exist',
                $queryClassName
            ));
        }

        $query = new $queryClassName();

        if (!$query instanceof ModelCriteria) {
            throw new RuntimeException(sprintf(
                'Query class "%s" is not an instance of ModelCriteria',
                $queryClassName
            ));
        }

        return $query->findPks($ids);
    }

    private function classNameForTable(string $tableName): string
    {
        return Propel::getDatabaseMap()->getTable($tableName)->getClassName();
    }

    private function resolveClassName(string $tableName): string
    {
        return $this->classNameForTable($tableName);
    }
}
