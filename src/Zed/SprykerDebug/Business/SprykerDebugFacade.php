<?php

namespace Inviqa\Zed\SprykerDebug\Business;

use Generator;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Inviqa\Zed\SprykerDebug\Business\SprykerDebugBusinessFactory getFactory()
 */
class SprykerDebugFacade extends AbstractFacade
{
    public function debugEntity(string $classFqn, array $ids): Generator
    {
        return $this->getFactory()->createReportGenerator()->generateFor($classFqn, $ids);
    }
}
