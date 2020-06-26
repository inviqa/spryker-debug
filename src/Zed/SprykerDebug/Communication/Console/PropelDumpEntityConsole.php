<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Console;

use Inviqa\Zed\SprykerDebug\Communication\Model\Cast;
use Inviqa\Zed\SprykerDebug\Communication\Model\Propel\CriteriaParser;
use Inviqa\Zed\SprykerDebug\Communication\Model\Propel\FieldParser;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use RuntimeException;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \Inviqa\Zed\SprykerDebug\Communication\SprykerDebugCommunicationFactory getFactory()
 */
class PropelDumpEntityConsole extends Console
{
    private const ARG_NAME = 'name';
    private const OPT_BY = 'by';
    private const OPT_LIMIT = 'limit';
    private const OPT_RECORDS = 'records';
    private const OPT_FIELDS = 'fields';

    /**
     * @var CriteriaParser
     */
    private $criteriaParser;

    /**
     * @var FieldParser
     */
    private $fieldParser;

    public function __construct()
    {
        parent::__construct();
        $this->criteriaParser = new CriteriaParser();
        $this->fieldParser = new FieldParser();
    }

    protected function configure()
    {
        $this->setName('debug:propel:entity');
        $this->addArgument(self::ARG_NAME, InputArgument::REQUIRED, 'Entity name');
        $this->addOption(self::OPT_BY, 'b', InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Simple field criteria, e.g. idProduct:1234 (many are joined by "and")');
        $this->addOption(self::OPT_LIMIT, 'l', InputOption::VALUE_REQUIRED, 'Limit number of records');
        $this->addOption(self::OPT_RECORDS, 'r', InputOption::VALUE_NONE, 'Display rows as individual records');
        $this->addOption(self::OPT_FIELDS, 'f', InputOption::VALUE_REQUIRED, 'Comma separted fields to select');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $tables = $this->getFactory()->createPropelTablesFactory()->createTables();
        $table = $tables->get(Cast::toString($input->getArgument(self::ARG_NAME)));
        $query = $this->buildQuery($table, $input);

        try {
            $entities = $query->findByArray($this->criteriaParser->parseMany(
                Cast::toArray($input->getOption(self::OPT_BY))
            ));
        } catch (PropelException $exception) {
            $output->writeln('<error>' . $exception->getMessage() . '</>');

            return 0;
        }

        if ($input->getOption(self::OPT_RECORDS)) {
            $this->renderRecords($entities, $output);
        } else {
            $this->renderRows($entities, $output);
        }

        $output->writeln(sprintf('%s entities', count($entities)));

        return 0;
    }

    private function buildQuery(TableMap $table, InputInterface $input): ModelCriteria
    {
        $limit = Cast::toInt($input->getOption(self::OPT_LIMIT));
        $fields = Cast::toStringOrNull($input->getOption(self::OPT_FIELDS));

        $queryClass = sprintf('%s%s', $table->getClassName(), 'Query');
        if (!class_exists($queryClass)) {
            throw new RuntimeException(sprintf(
                'Could not find query class "%s" for "%s"',
                $queryClass,
                $table->getClassName()
            ));
        }
        $query = new $queryClass();
        assert($query instanceof ModelCriteria);

        if ($limit) {
            $query->setLimit($limit);
        }

        if ($fields) {
            $query->select($this->fieldParser->parse($fields));
        }

        return $query;
    }

    private function renderRecords($entities, OutputInterface $output)
    {
        foreach ($entities as $index => $entity) {
            $output->writeln(sprintf('<comment>// #%s</>', $index + 1));
            $table = new Table($output);
            foreach ($this->entityToCells($entity) as $field => $value) {
                $table->addRow([$field, $value]);
            }
            $table->render();
        }
    }

    private function renderRows($entities, OutputInterface $output)
    {
        $table = new Table($output);
        $header = null;

        foreach ($entities as $index => $entity) {
            $cells = $this->entityToCells($entity);
            if ($header === null) {
                $header = array_keys($cells);
            }

            $table->addRow($cells);
        }

        if ($header) {
            $table->setHeaders($header);
        }

        $table->render();
    }

    private function entityToCells($entity): array
    {
        if (is_scalar($entity)) {
            return [ $entity ];
        }

        if ($entity instanceof ActiveRecordInterface) {
            if (!method_exists($entity, 'toArray')) {
                throw new RuntimeException(
                    'Active record has no ->toArray method'
                );
            }
            $entity = $entity->toArray();
        }

        if (!is_array($entity)) {
            throw new RuntimeException(sprintf(
                'Entity/row data is not an array, is "%s"',
                gettype($entity)
            ));
        }

        return array_map(function ($value) {
            return json_encode($value);
        }, $entity);
    }
}
