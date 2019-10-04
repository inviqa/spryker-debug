<?php

namespace Inviqa\SprykerDebug\Zed\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class QueuesOverviewConsole extends Console
{
    public function configure()
    {
        $this->setName('debug:queues');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getFactory()->getRabbitClient();
    }
}
