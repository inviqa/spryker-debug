<?php

namespace Inviqa\SprykerDebug\Tests\Acceptance\Context;

use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Orm\Zed\Product\Persistence\SpyProduct;
use Orm\Zed\SprykerDebug\Persistence\PyzTestEntityQuery;

class PropelContext implements Context
{

    /**
     * @Given a test entity exists with name :name
     */
    public function thereFollowingEntityExists(string $name)
    {
        $testEntity = PyzTestEntityQuery::create()
            ->filterByName($name)
            ->findOneOrCreate();
        $testEntity->save();
    }
}
