<?php

namespace Inviqa\SprykerDebug\Tests;

use GuzzleHttp\Client;
use Inviqa\SprykerDebug\Tests\Support\ApplicationBuilder;
use Inviqa\SprykerDebug\Tests\Support\Workspace\Workspace;
use Psr\Container\ContainerInterface;
use Spryker\Client\RabbitMq\RabbitMqClient;
use Spryker\Client\RabbitMq\RabbitMqClientInterface;
use Spryker\Service\Container\Container;
use Spryker\Shared\Application\Application;
use Spryker\Shared\Twig\TwigFilesystemLoader;
use Spryker\Zed\Console\Communication\ConsoleBootstrap;
use Symfony\Component\Debug\Debug;
use Twig\Environment;

class TestContainer extends Container
{
    public const YVES_HOST = 'http://localhost:8086';

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
        $this->registerYves();
    }

    private function registerApplication(): void
    {
        $this[Application::class] = $this->share(function () {
            return $this->initApplication();
        });
        $this[ConsoleBootstrap::class] = function (Container $container) {
            $container->get(Application::class);

            return new ConsoleBootstrap();
        };
        $this[Environment::class] = $this->share(function (Container $container) {
            return $container[Application::class]['twig'];
        });
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

    private function registerYves()
    {
        $this[Client::class] = $this->share(function (Container $container) {
            return new Client([
                'base_uri' => self::YVES_HOST,
            ]);
        });
    }

    private function initApplication(): ContainerInterface
    {
        $app = ApplicationBuilder::create(__DIR__ . '/App', 'GB')
            ->build();

        $app->extend('twig.loader.zed', function (TwigFilesystemLoader $zedLoader) {
            $zedLoader->addPath(__DIR__ . '/Workspace', 'workspace');

            return $zedLoader;
        });

        return $app;
    }
}
