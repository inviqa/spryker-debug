<?php

namespace InviqaSprykerDebug\Zed\Communication\Console;

use Spryker\Shared\Config\Config;
use Spryker\Shared\Propel\PropelConstants;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class DatabaseShellConsole extends Console
{
    private const OPTION_SHELL = 'shell';

    protected function configure()
    {
        $this->setName('inviqa:database:shell');
        $this->addOption(self::OPTION_SHELL, 's', InputOption::VALUE_REQUIRED, 'Shell to use', 'psql');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $process = new Process($input->getOption(self::OPTION_SHELL), null, [
            'PGPASSWORD' => Config::get(PropelConstants::ZED_DB_PASSWORD),
            'PGUSER' => Config::get(PropelConstants::ZED_DB_USERNAME),
            'PGHOST' => Config::get(PropelConstants::ZED_DB_HOST),
            'PGDATABASE' => Config::get(PropelConstants::ZED_DB_DATABASE),
            'PGPORT' => Config::get(PropelConstants::ZED_DB_PORT),
        ]);
        $process->setTty(true);
        $process->run();

        return $process->getExitCode();
    }
}
