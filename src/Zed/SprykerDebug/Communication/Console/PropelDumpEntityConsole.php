<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Console;

use Inviqa\Zed\SprykerDebug\Communication\Model\Cast;
use Inviqa\Zed\SprykerDebug\Communication\Model\Propel\CriteriaParser;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Map\ColumnMap;
use Propel\Runtime\Map\Exception\TableNotFoundException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Propel;
use RuntimeException;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @method \Inviqa\Zed\SprykerDebug\Communication\SprykerDebugCommunicationFactory getFactory()
 */
class PropelDumpEntityConsole extends Console
{
    /**
     * @var CriteriaParser
     */
    private $criteriaParser;
    public const ARG_NAME = 'name';
    const OPT_BY = 'by';
    const OPT_LIMIT = 'limit';

    public function __construct()
    {
        parent::__construct();
        $this->criteriaParser = new CriteriaParser();
    }

    protected function configure()
    {
        $this->setName('debug:propel:entity');
        $this->addArgument(self::ARG_NAME, InputArgument::REQUIRED, 'Entity name');
        $this->addOption(self::OPT_BY, 'b', InputOption::VALUE_REQUIRED|InputOption::VALUE_IS_ARRAY, 'Simple (single) criteria, e.g. sku:1234');
        $this->addOption(self::OPT_LIMIT, 'l', InputOption::VALUE_REQUIRED, 'Limit number of records');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $tables = $this->getFactory()->createPropelTablesFactory()->createTables();
        $table = $tables->get(Cast::toString($input->getArgument(self::ARG_NAME)));
        $queryClass = sprintf('%s%s', $table->getClassName(), 'Query');
        if (!class_exists($queryClass)) {
            throw new RuntimeException(sprintf(
                'Could not find query class "%s" for "%s"',
                $queryClass, $table->getClassName()
            ));
        }
        $query = new $queryClass;
        assert($query instanceof ModelCriteria);

        if ($limit = Cast::toInt($input->getOption(self::OPT_LIMIT))) {
            $query->setLimit($limit);
        }

        try {
            $entities = $query->findByArray($this->criteriaParser->parseMany(
                Cast::toArray($input->getOption(self::OPT_BY))
            ));
        } catch (RuntimeException $exception) {
            $output->writeln('<error>' . $exception->getMessage() . '</>');
            return 0;
        }

        foreach ($entities as $index => $entity) {
            $output->writeln(sprintf('<comment>// #%s</>', $index + 1));
            $table = new Table($output);
            foreach ($entity->toArray() as $field => $value) {
                $table->addRow([$field, json_encode($value)]);
            }
            $table->render();
        }

        $output->writeln(sprintf('%s entities', count($entities)));
    }
}
