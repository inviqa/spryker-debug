<?php

namespace InviqaSprykerDebug\Zed\Communication\Console;

use Spryker\Shared\Config\Config;
use Spryker\Shared\Propel\PropelConstants;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class DatabaseShellConsole extends AbstractShellConsole
{
    private const OPTION_SHELL = 'shell';

    protected function configure()
    {
        parent::configure();
        $this->setName('debug:database:shell');
        $this->setDescription('Launch a postgres shell for the cofigured connection');
        $this->addOption(self::OPTION_SHELL, 's', InputOption::VALUE_REQUIRED, 'Shell to use', 'psql');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        assert($output instanceof ConsoleOutputInterface);
        $process = new Process(
            $this->resolveShellPath($input->getOption(self::OPTION_SHELL)),
            null,
            [
                'PGPASSWORD' => Config::get(PropelConstants::ZED_DB_PASSWORD),
                'PGUSER' => Config::get(PropelConstants::ZED_DB_USERNAME),
                'PGHOST' => Config::get(PropelConstants::ZED_DB_HOST),
                'PGDATABASE' => Config::get(PropelConstants::ZED_DB_DATABASE),
                'PGPORT' => Config::get(PropelConstants::ZED_DB_PORT),
            ]
        );
        $output->getErrorOutput()->writeln(sprintf('<comment>Executing "%s" (connection params passed via env vars)</comment>', $process->getCommandLine()));
        $output->getErrorOutput()->writeln('<info>Type "\\q" to quit</info>');
        $process->setTty(true);
        $process->run();

        return $process->getExitCode();
    }
}
