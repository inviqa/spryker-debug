<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Console;

use Inviqa\Zed\SprykerDebug\Communication\Model\Cast;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \Inviqa\Zed\SprykerDebug\Communication\SprykerDebugCommunicationFactory getFactory()
 */
class DebugQueuesConsole extends Console
{
    public const OPT_VHOST = 'vhost';
    public const ARG_PATTERN = 'pattern';
    const OPT_NON_EMPTY = 'non-empty';

    public function configure()
    {
        $this->setName('debug:queues');
        $this->addOption(self::OPT_VHOST, null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Filter by vhost');
        $this->addOption(self::OPT_NON_EMPTY, 'N', InputOption::VALUE_NONE, 'Only show non-empty queues');
        $this->addArgument(self::ARG_PATTERN, InputArgument::OPTIONAL, 'Filter pattern');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = $this->getFactory()->getRabbitClient();

        $table = new Table($output);
        $table->setHeaders([
            self::OPT_VHOST,
            'name',
            'state',
            'ready',
            'unacked',
            'total',
        ]);

        $queues = $client->queues();

        if ($input->getOption(self::OPT_VHOST)) {
            $queues = $queues->byVhost(...Cast::toArray($input->getOption(self::OPT_VHOST)));
        }

        if ($input->getOption(self::OPT_NON_EMPTY)) {
            $queues = $queues->nonEmpty();
        }

        if ($input->getArgument(self::ARG_PATTERN)) {
            $queues = $queues->filterByString(Cast::toString($input->getArgument(self::ARG_PATTERN)));
        }

        foreach ($queues as $queue) {
            $table->addRow([
                $queue->vhost(),
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
