<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Console;

use Inviqa\Zed\SprykerDebug\Communication\Model\Cast;
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

    protected function configure(): void
    {
        $this->setName('debug:redis:shell');
        $this->setDescription('Connects to the redis shell using the storage configuration');
        $this->addOption(self::OPTION_SHELL, 's', InputOption::VALUE_REQUIRED, 'Shell to use', 'redis-cli');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        assert($output instanceof ConsoleOutputInterface);
        $process = new Process(
            array_merge([
                $this->resolveShellPath(Cast::toString($input->getOption(self::OPTION_SHELL))),
            ], $this->buildArgs()),
            null,
            [
                'REDISCLI_AUTH' => Config::get('STORAGE_REDIS:STORAGE_REDIS_PASSWORD', Config::get(StorageConstants::STORAGE_REDIS_PASSWORD, '')),
            ]
        );
        $output->getErrorOutput()->writeln(sprintf('<comment>Executing "%s" (password passed via env REDISCLI_AUTH)</comment>', $process->getCommandLine()));
        $output->getErrorOutput()->writeln('<info>Type "exit" to quit</info>');
        $process->setTty(true);
        $process->setTimeout(null);
        $process->run();

        return Cast::toInt($process->getExitCode());
    }

    private function buildArgs(): array
    {
        return [
            '-h',
            Config::get('STORAGE_REDIS:STORAGE_REDIS_HOST', Config::get(StorageConstants::STORAGE_REDIS_HOST, '')),
            '-p',
            Config::get('STORAGE_REDIS:STORAGE_REDIS_PORT', Config::get(StorageConstants::STORAGE_REDIS_PORT, '')),
            '-n',
            Config::get('STORAGE_REDIS:STORAGE_REDIS_DATABASE', Config::get(StorageConstants::STORAGE_REDIS_DATABASE, '')),
        ];
    }
}
