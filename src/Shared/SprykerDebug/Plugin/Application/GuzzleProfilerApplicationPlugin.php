<?php

namespace Inviqa\Shared\SprykerDebug\Plugin\Application;

use Closure;
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
        (new HandlerStackContainer())->addMiddleware(new class($container->get('stopwatch')) implements MiddlewareInterface {

            private $stopwatch;

            public function __construct(Stopwatch $stopwatch)
            {
                $this->stopwatch = $stopwatch;
            }

            public function getName(): string
            {
                return 'HTTP stopwatch profiler';
            }

            public function getCallable(): Closure {
                return function (callable $handler) {
                    return function (
                        RequestInterface $request,
                        array $options
                    ) use ($handler) {
                        $this->stopwatch->start($request->getUri()->__toString());
                        $response = $handler($request, $options);
                        $this->stopwatch->stop($request->getUri()->__toString());
                        return $response;
                    };
                };
            }
        });

        return $container;
    }
}
