<?php

namespace Inviqa\Shared\SprykerDebug\Plugin\Application;

use Closure;
use Inviqa\Shared\SprykerDebug\Plugin\Guzzle\GuzzleStopwatchProfilerMiddleware;
use Psr\Http\Message\RequestInterface;
use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\ApplicationExtension\Dependency\Plugin\ApplicationPluginInterface;
use Spryker\Shared\ZedRequest\Client\HandlerStack\HandlerStackContainer;
use Spryker\Shared\ZedRequest\Client\Middleware\MiddlewareInterface;
use Symfony\Component\Stopwatch\Stopwatch;

class GuzzleProfilerApplicationPlugin implements ApplicationPluginInterface
{
    /**
     * {@inheritDoc}
     */
    public function provide(ContainerInterface $container): ContainerInterface
    {
        $stack = (new HandlerStackContainer());
        $stack->addMiddleware(new GuzzleStopwatchProfilerMiddleware($container->get('stopwatch')));

        return $container;
    }
}
