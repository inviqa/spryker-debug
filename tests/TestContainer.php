<?php

namespace Inviqa\SprykerDebug\Tests;

use Inviqa\SprykerDebug\Tests\Support\ApplicationBuilder;
use Inviqa\SprykerDebug\Tests\Support\Workspace\Workspace;
use Inviqa\Zed\SprykerDebug\Behat\State\LocalizationState;
use Inviqa\Zed\SprykerDebug\Behat\State\ProcessState;
use Spryker\Client\RabbitMq\RabbitMqClient;
use Spryker\Client\RabbitMq\RabbitMqClientInterface;
use Spryker\Service\Container\Container;
use Spryker\Shared\Application\Application;
use Spryker\Zed\Console\Communication\ConsoleBootstrap;
use Spryker\Zed\Product\Business\ProductFacade;
use Spryker\Zed\Product\Business\ProductFacadeInterface;
use Symfony\Component\Debug\Debug;

class TestContainer extends Container
{
    public function __construct()
    {
        Debug::enable();
        parent::__construct();
        $this->registerServices();
    }

    private function registerServices(): void
    {
        $this->registerApplication();
        $this->registerSupport();
        $this->registerRabbit();
    }

    private function initApplication(): Application
    {
        return ApplicationBuilder::create(__DIR__ . '/App', 'GB')
            ->build();
    }

    private function registerApplication(): void
    {
        $this[Application::class] = $this->initApplication();
        $this[ConsoleBootstrap::class] = function () {
            return new ConsoleBootstrap();
        };
    }

    private function registerSupport(): void
    {
        $this[Workspace::class] = $this->share(function () {
            return new Workspace(__DIR__ . '/Workspace');
        });
    }

    private function registerRabbit(): void
    {
        $this[RabbitMqClientInterface::class] = $this->share(function () {
            return new RabbitMqClient();
        });
    }
}
