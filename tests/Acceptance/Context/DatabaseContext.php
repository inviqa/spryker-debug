<?php

namespace InviqaSprykerDebug\Tests\Acceptance\Context;

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
        if (Propel::getConnection()->beginTransaction() === false) {
            throw new RuntimeException(
                sprintf(
                    'Could not start DB transaction in Behat scenario "%s"',
                    $scope->getName()
                )
            );
        }
    }

    /**
     * @AfterScenario @db-transaction
     */
    public function rollbackTransaction(ScenarioScope $scope)
    {
        if (Propel::getConnection()->rollBack() === false) {
            throw new RuntimeException(
                sprintf(
                    'Could not rollback DB transaction in Behat scenario "%s"',
                    $scope->getName()
                )
            );
        }
    }
}
