<?php

namespace Inviqa\SprykerDebug\Zed\Communication\Console;

use Inviqa\SprykerDebug\Zed\Communication\Model\Cast;
use Spryker\Shared\Config\Config;
use Spryker\Shared\Storage\StorageConstants;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class RedisShellConsole extends AbstractShellConsole
{
    private const OPTION_SHELL = 'shell';

    protected function configure()
    {
        $this->setName('debug:redis:shell');
        $this->setDescription('Connects to the redis shell using the storage configuration');
        $this->addOption(self::OPTION_SHELL, 's', InputOption::VALUE_REQUIRED, 'Shell to use', 'redis-cli');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        assert($output instanceof ConsoleOutputInterface);
        $process = new Process(
            array_merge([
                $this->resolveShellPath(Cast::toString($input->getOption(self::OPTION_SHELL))),
            ], $this->buildArgs()),
            null,
            [
                'REDISCLI_AUTH' => Config::get(StorageConstants::STORAGE_REDIS_PASSWORD),
            ]
        );
        $output->getErrorOutput()->writeln(sprintf('<comment>Executing "%s" (password passed via env REDISCLI_AUTH)</comment>', $process->getCommandLine()));
        $output->getErrorOutput()->writeln('<info>Type "exit" to quit</info>');
        $process->setTty(true);
        $process->run();

        return Cast::toInt($process->getExitCode());
    }

    private function buildArgs(): array
    {
        return [
            '-h',
            Config::get(StorageConstants::STORAGE_REDIS_HOST),
            '-p',
            Config::get(StorageConstants::STORAGE_REDIS_PORT),
            '-n',
            Config::get(StorageConstants::STORAGE_REDIS_DATABASE),
        ];
    }
}
