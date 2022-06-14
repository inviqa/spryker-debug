<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Console;

use Inviqa\Zed\SprykerDebug\Communication\Model\Cast;
use RuntimeException;
use Spryker\Zed\Kernel\Communication\Console\Console;
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

    private const OPT_JSON = 'json';

    private const OPT_COUNT = 'count';

    public function configure(): void
    {
        $this->setName('debug:queues:peek');
        $this->setDescription('Peek at messages in a queue');
        $this->addArgument(self::ARG_NAME, InputArgument::REQUIRED, 'Name of queue to peak into');
        $this->addOption(self::OPT_VHOST, null, InputOption::VALUE_REQUIRED, 'Filter by vhost', '%2f');
        $this->addOption(self::OPT_JSON, null, InputOption::VALUE_NONE, 'Pretty print JSON output');
        $this->addOption(self::OPT_COUNT, null, InputOption::VALUE_REQUIRED, 'Specify number of messages', 1);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $client = $this->getFactory()->getRabbitClient();

        $messages = $client->peek(
            Cast::toString($input->getOption(self::OPT_VHOST)),
            Cast::toString($input->getArgument(self::ARG_NAME)),
            Cast::toInt($input->getOption(self::OPT_COUNT)),
        );

        foreach ($messages as $message) {
            $output->writeln($this->formatPayload($input, $message->payload()), OutputInterface::OUTPUT_RAW);
        }

        return self::CODE_SUCCESS;
    }

    private function formatPayload(InputInterface $input, string $message): string
    {
        if ($input->getOption(self::OPT_JSON)) {
            $decoded = json_decode($message);
            if ($decoded === false) {
                throw new RuntimeException(sprintf(
                    'Could not decode JSON: "%s"',
                    json_last_error_msg(),
                ));
            }

            $encoded = json_encode($decoded, JSON_PRETTY_PRINT);
            if ($encoded === false) {
                throw new RuntimeException(
                    'Could not encode JSON',
                );
            }

            return $encoded;
        }

        return $message;
    }
}
