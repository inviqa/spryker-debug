<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Console;

use Propel\Runtime\Map\ColumnMap;
use Propel\Runtime\Map\Exception\TableNotFoundException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Propel;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @method \Inviqa\Zed\SprykerDebug\Communication\SprykerDebugCommunicationFactory getFactory()
 */
class PropelDumpMetadataConsole extends Console
{
    public const ARG_PATTERN = 'pattern';

    protected function configure()
    {
        $this->setName('debug:propel:metadata');
        $this->addArgument(self::ARG_PATTERN, InputArgument::OPTIONAL, 'Filter entities / tables');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $style = new SymfonyStyle($input, $output);
        $selected = $input->getArgument(self::ARG_PATTERN);
        $tables = $this->getFactory()->createPropelTablesFactory()->createTables();

        if (empty($selected)) {
            $selected = $style->choice('Select entity:', array_map(function (TableMap $tableMap) {
                return sprintf('%s', $tableMap->getName());
            }, $tables->toArray()));
        }

        if (null === $selected) {
            $output->writeln('No table selected');
            return 0;
        }

        $this->dumpTable($output, $style, $tables->get($selected));
    }

    private function dumpTable(OutputInterface $output, SymfonyStyle $style, TableMap $table)
    {
        $style->title($table->getPhpName());

        $this->renderGeneral($style, $table);
        $this->renderColumns($style, $output, $table);
        $this->renderBehaviors($style, $table);
        $this->renderForeignKeys($style, $table);
        $this->renderRelations($style, $table);
    }

    private function renderBehaviors(SymfonyStyle $style, TableMap $table): void
    {
        $style->section('Behaviors');
        if (!$table->getBehaviors()) {
            $style->comment('None');

            return;
        }

        $style->definitionList(array_map(function (array $behavior) {
            return json_encode($behavior, JSON_PRETTY_PRINT);
        }, $table->getBehaviors()));
    }

    private function renderGeneral(SymfonyStyle $style, TableMap $table)
    {
        $style->section('General');
        $style->definitionList(
            ['class' => $table->getClassName()],
            ['collection' => $table->getCollectionClassName()],
            ['table' => $table->getName()],
            ['primaryKeys' => json_encode($table->getPrimaryKeys())]
        );
    }

    private function renderForeignKeys(SymfonyStyle $style, TableMap $table)
    {
        $style->section('Foreign Keys');

        if (!$table->getForeignKeys()) {
            $style->comment('None');

            return;
        }

        foreach ($table->getForeignKeys() as $columnMap) {
            assert($columnMap instanceof ColumnMap);
            $style->writeln(sprintf(' %s <info>=></> %s.%s', $columnMap->getName(), $columnMap->getRelatedTableName(), $columnMap->getRelatedColumnName()));
        }
    }

    private function renderRelations(SymfonyStyle $style, TableMap $table)
    {
        $style->section('Relations');

        if (!$table->getRelations()) {
            $style->comment('None');

            return;
        }
        foreach ($table->getRelations() as $relation) {
            assert($relation instanceof RelationMap);
            $style->writeln(sprintf(
                ' %s <info>%s</info> %s',
                implode(' ', array_map(function (ColumnMap $column) {
                    return $column->getName();
                }, $relation->getLocalColumns())),
                $this->relationType($relation->getType()),
                $relation->getForeignTable()->getName()
            ));
        }
    }

    private function relationType(int $relationType): string
    {
        switch ($relationType) {
            case RelationMap::MANY_TO_ONE:
                return '* -> 1';
            case RelationMap::ONE_TO_MANY:
                return '1 -> *';
            case RelationMap::ONE_TO_ONE:
                return '1 -> 1';
            case RelationMap::MANY_TO_MANY:
                return '* -> 1';
            default:
                return '?';
        }
    }

    private function renderColumns(SymfonyStyle $style, OutputInterface $output, TableMap $tableMap)
    {
        $style->section('Schema');

        $table = new Table($output);
        $table->setHeaders([
            'column',
            'type',
            'default',
            'size',
        ]);
        foreach ($tableMap->getColumns() as $column) {
            assert($column instanceof ColumnMap);
            $table->addRow([
                $column->getName(),
                $column->getType(),
                $column->getDefaultValue(),
                $column->getSize(),
            ]);
        }

        $table->render();
        $output->write(PHP_EOL);
    }
}
