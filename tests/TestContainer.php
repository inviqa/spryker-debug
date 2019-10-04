<?php

namespace InviqaSprykerDebug\Tests;

use InviqaSprykerDebug\Tests\Support\ApplicationBuilder;
use InviqaSprykerDebug\Tests\Support\Workspace\Workspace;
use InviqaSprykerDebug\Zed\Behat\State\LocalizationState;
use InviqaSprykerDebug\Zed\Behat\State\ProcessState;
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
        $this[Application::class] = $this->initApplication();

        $this[Workspace::class] = $this->share(function () {
            return new Workspace(__DIR__ . '/Workspace');
        });

        $this[ConsoleBootstrap::class] = function () {
            return new ConsoleBootstrap();
        };

        $this[ProductFacadeInterface::class] = $this->share(function () {
            return new ProductFacade();
        });

        $this[ProcessState::class] = $this->share(function () {
            return new ProcessState();
        });

        $this[LocalizationState::class] = $this->share(function () {
            return new LocalizationState();
        });
    }

    private function initApplication(): Application
    {
        return ApplicationBuilder::create(__DIR__ . '/App', 'GB')
            ->build();
    }
}
