<?php

namespace Pyz\Zed\Application\Communication;

use Spryker\Zed\Application\Communication\ApplicationCommunicationFactory as SprykerApplicationCommunicationFactory;
use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\Kernel\Container\ContainerProxy;

/**
 * @method \Spryker\Zed\Application\ApplicationConfig getConfig()
 * @method \Spryker\Zed\Application\Business\ApplicationFacadeInterface getFacade()
 */
class ApplicationCommunicationFactory extends SprykerApplicationCommunicationFactory
{
    static public $applicationContainer;

    public function createServiceContainer(): ContainerInterface
    {
        self::$applicationContainer = new ContainerProxy(['logger' => null, 'debug' => $this->getConfig()->isDebugModeEnabled(), 'charset' => 'UTF-8']);

        return self::$applicationContainer;
    }
}
