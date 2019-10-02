<?php

namespace InviqaSprykerDebug\Zed\Behat\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\ScenarioScope;
use Propel\Runtime\Propel;
use RuntimeException;

class DatabaseContext implements Context
{
    /**
     * @BeforeScenario @db-transaction
     */
    public function startTransaction(ScenarioScope $scope)
    {
        if (false === Propel::getConnection()->beginTransaction()) {
            throw new RuntimeException(sprintf(
                'Could not start DB transaction in Behat scenario "%s"',
                $scope->getName()
            ));
        }
    }

    /**
     * @AfterScenario @db-transaction
     */
    public function rollbackTransaction(ScenarioScope $scope)
    {
        if (false === Propel::getConnection()->rollBack()) {
            throw new RuntimeException(sprintf(
                'Could not rollback DB transaction in Behat scenario "%s"',
                $scope->getName()
            ));
        }
    }
}
