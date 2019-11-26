<?php

namespace Inviqa\Shared\SprykerDebug\Plugin\Application;

use Closure;
use Inviqa\Shared\SprykerDebug\Plugin\Guzzle\GuzzleRequestProfilerMiddleware;
use Inviqa\Shared\SprykerDebug\Plugin\Guzzle\GuzzleStopwatchProfilerMiddleware;
use Inviqa\Shared\SprykerDebug\Plugin\Guzzle\RequestCollection;
use Inviqa\Shared\SprykerDebug\Plugin\Guzzle\RequestProfile;
use Inviqa\Shared\SprykerDebug\Plugin\WebProfiler\Guzzle\GuzzleProfilerDataCollector;
use Psr\Http\Message\RequestInterface;
use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\ApplicationExtension\Dependency\Plugin\ApplicationPluginInterface;
use Spryker\Shared\Config\Profiler\ConfigProfilerCollector;
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
        $container[RequestCollection::class] = function () {
            return new RequestCollection();
        };
        $container[GuzzleProfilerDataCollector::class] = function (ContainerInterface $container) {
            return new GuzzleProfilerDataCollector($container->get(RequestCollection::class));
        };

        $stack = (new HandlerStackContainer());
        $stack->addMiddleware(new GuzzleStopwatchProfilerMiddleware($container->get('stopwatch')));
        $stack->addMiddleware(new GuzzleRequestProfilerMiddleware($container->get(RequestCollection::class)));

        return $container;
    }
}
