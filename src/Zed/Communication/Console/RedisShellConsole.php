<?php

namespace InviqaSprykerDebug\Zed\Communication\Console;

use Spryker\Shared\Config\Config;
use Spryker\Shared\Propel\PropelConstants;
use Spryker\Shared\Storage\StorageConstants;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\ExecutableFinder;
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
            $this->buildCommand($input),
            null,
            [
                'REDISCLI_AUTH' => Config::get(StorageConstants::STORAGE_REDIS_PASSWORD),
            ]
        );
        $output->getErrorOutput()->writeln(sprintf('<comment>Executing "%s" (password passed via env REDISCLI_AUTH)</comment>', $process->getCommandLine()));
        $output->getErrorOutput()->writeln('<info>Type "exit" to quit</info>');
        $process->setTty(true);
        $process->run();

        return $process->getExitCode();
    }

    private function buildCommand(InputInterface $input): string
    {
        return sprintf(
            '%s -h %s -p %s -n %s',
            $this->resolveShellPath($input->getOption(self::OPTION_SHELL)),
            Config::get(StorageConstants::STORAGE_REDIS_HOST),
            Config::get(StorageConstants::STORAGE_REDIS_PORT),
            Config::get(StorageConstants::STORAGE_REDIS_DATABASE)
        );
    }
}
