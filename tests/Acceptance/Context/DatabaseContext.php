<?php

namespace Inviqa\SprykerDebug\Tests\Acceptance\Context;

use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\ScenarioScope;
use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Propel;
use RuntimeException;
use function Safe\json_decode;
use Safe\Exceptions\JsonException;

class DatabaseContext implements Context
{
    /**
     * @var array
     */
    private $map;

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

    /**
     * @Given the entity :arg1 exists as :arg2:
     */
    public function theTableHasTheFollowingData(string $className, $tag, TableNode $table)
    {
        $entity = new $className;

        $data = array_map(function($value) {
            try {
                return json_decode($value, true);
            } catch (JsonException $e) {
                if (preg_match('{<(.*)>}', $value, $matches)) {
                    $key = $matches[1];
                    if (!isset($this->map[$key])) {
                        throw new RuntimeException(sprintf(
                            'No previously persisted entity with tag "%s" exists, I have "%s"',
                            $key, implode('", "', array_keys($this->map))
                        ));
                    }
                    return $this->map[$key];
                }

                throw new RuntimeException(sprintf('Could not decode JSON "%s"', $value), 0, $e);
            }
        }, $table->getRowsHash());

        $entity->fromArray($data, TableMap::TYPE_PHPNAME);
        $entity->save();

        $this->map[$tag] = $entity->getPrimaryKey();
    }
}
