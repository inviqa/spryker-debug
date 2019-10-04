<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \Inviqa\Zed\SprykerDebug\Communication\SprykerDebugCommunicationFactory getFactory()
 */
class QueuesOverviewConsole extends Console
{
    public function configure()
    {
        $this->setName('debug:queues');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = $this->getFactory()->getRabbitClient();

        $table = new Table($output);
        $table->setHeaders([
            'name',
            'state',
            'ready',
            'unacked',
            'total',
        ]);
        foreach ($client->queues() as $queue) {
            $table->addRow([
                $queue->name(),
                $queue->state(),
                $queue->readyMessages(),
                $queue->unackedMessages(),
                $queue->totalMessages(),
            ]);
        }
        $table->render();
    }
}
