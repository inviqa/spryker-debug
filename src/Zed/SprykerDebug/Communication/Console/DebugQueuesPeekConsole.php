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
class DebugQueuesPeekConsole extends Console
{
    private const ARG_NAME = 'peek';
    private const OPT_VHOST = 'vhost';

    public function configure()
    {
        $this->setName('debug:queues:peek');
        $this->addArgument(self::ARG_NAME, InputArgument::REQUIRED, 'Name of queue to peak into');
        $this->addOption(self::OPT_VHOST, null, InputOption::VALUE_REQUIRED, 'Filter by vhost', '%2f');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = $this->getFactory()->getRabbitClient();

        $messages = $client->peek($input->getOption(self::OPT_VHOST), $input->getArgument(self::ARG_NAME));

        foreach ($messages as $message) {
            $output->writeln($message->payload(), OutputInterface::OUTPUT_RAW);
        }
    }
}
