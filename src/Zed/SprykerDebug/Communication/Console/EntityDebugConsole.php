<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Console;

use Inviqa\Zed\SprykerDebug\Communication\Model\Cast;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \Inviqa\Zed\SprykerDebug\Business\SprykerDebugFacade getFacade()
 */
class EntityDebugConsole extends Console
{
    const ARG_FQN = 'fqn';
    const ARG_IDS = 'ids';


    protected function configure()
    {
        $this->setName('debug:entity');
        $this->setDescription('Gather and show information relating to a given Propel entity (referenced by it\'s table name');
        $this->addArgument(self::ARG_FQN, InputArgument::REQUIRED);
        $this->addArgument(self::ARG_IDS, InputArgument::IS_ARRAY);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $generator = $this->getFacade()->debugEntity(
            Cast::toString($input->getArgument(self::ARG_FQN)),
            array_map(function ($value) {
                return Cast::toInt($value);
            }, Cast::toArray($input->getArgument(self::ARG_IDS)))
        );

        foreach ($generator as $report) {
            $output->writeln($report);
        }
    }
}
