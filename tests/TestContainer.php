<?php

namespace Inviqa\Spryker\Debug\Tests;

use Inviqa\Spryker\Debug\Shared\Test\ApplicationBuilder;
use Silex\Application;
use Spryker\Service\Container\Container;
use Spryker\Zed\Console\Communication\ConsoleBootstrap;
use Spryker\Zed\Product\Business\ProductFacade;
use Spryker\Zed\Product\Business\ProductFacadeInterface;
use Symfony\Component\Debug\Debug;

class TestContainer extends Container
{
    public function __construct()
    {
        Debug::enable();

        parent::__construct([
            Application::class => ApplicationBuilder::create(__DIR__ . '/App', 'GB')->build(),
            ConsoleBootstrap::class => new ConsoleBootstrap(),
            ProductFacadeInterface::class => function () {
                return new ProductFacade();
            }

        ]);
    }
}
