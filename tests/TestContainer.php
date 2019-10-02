<?php

namespace InviqaSprykerDebug\Tests;

use InviqaSprykerDebug\Shared\Test\ApplicationBuilder;
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
        $this[ConsoleBootstrap::class] = function () {
            return new ConsoleBootstrap();
        };
        $this[ProductFacadeInterface::class] = function () {
                return new ProductFacade();
        };
    }

    private function initApplication(): Application
    {
        return ApplicationBuilder::create(__DIR__ . '/App', 'GB')
            ->build();
    }
}
