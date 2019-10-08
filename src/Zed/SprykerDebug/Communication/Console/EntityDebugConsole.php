<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EntityDebugConsole extends Console
{
    protected function configure()
    {
        $this->setName('debug:entity');
        $this->setDescription('Gather and show information relating to a given Propel entity (referenced by it\'s table name');
        $this->addArgument('fqn', InputArgument::REQUIRED);
        $this->addArgument('ids', InputArgument::IS_ARRAY);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    }
}
