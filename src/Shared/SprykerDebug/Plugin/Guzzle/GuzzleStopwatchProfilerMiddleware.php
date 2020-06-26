<?php

namespace Inviqa\Shared\SprykerDebug\Plugin\Guzzle;

use Closure;
use Psr\Http\Message\RequestInterface;
use Spryker\Shared\ZedRequest\Client\Middleware\MiddlewareInterface;
use Symfony\Component\Stopwatch\Stopwatch;

class GuzzleStopwatchProfilerMiddleware implements MiddlewareInterface
{
    /**
     * @var Stopwatch
     */
    private $stopwatch;

    public function __construct(Stopwatch $stopwatch)
    {
        $this->stopwatch = $stopwatch;
    }

    public function getName(): string
    {
        return 'HTTP stopwatch profiler';
    }

    public function getCallable(): Closure
    {
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
}
