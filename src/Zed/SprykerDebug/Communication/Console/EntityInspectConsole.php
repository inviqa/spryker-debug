<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;

class EntityInspectConsole extends Console
{
    protected function configure()
    {
        $this->setName('debug:entity:inspect');
        $this->setDescription('Gather and show information relating to a given Propel entity (referenced by it\'s table name');
    }
}
