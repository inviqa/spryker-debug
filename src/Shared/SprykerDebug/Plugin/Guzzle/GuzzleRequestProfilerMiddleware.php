<?php

namespace Inviqa\Shared\SprykerDebug\Plugin\Guzzle;

use Closure;
use GuzzleHttp\Promise\RejectedPromise;
use Psr\Http\Message\RequestInterface;
use Spryker\Shared\ZedRequest\Client\Middleware\MiddlewareInterface;
use Symfony\Component\Stopwatch\Stopwatch;
use Inviqa\Shared\SprykerDebug\Plugin\Guzzle\RequestCollection;
use Inviqa\Shared\SprykerDebug\Plugin\Guzzle\RequestProfile;

class GuzzleRequestProfilerMiddleware implements MiddlewareInterface
{
    /**
     * @var RequestCollection
     */
    private $collection;

    public function __construct(RequestCollection $collection)
    {
        $this->collection = $collection;
    }

    public function getName(): string
    {
        return 'HTTP profiler';
    }

    public function getCallable(): Closure
    {
        return function (callable $handler) {
            return function (
                RequestInterface $request,
                array $options
            ) use ($handler) {
                return $handler($request, $options)->then(function ($response) use ($request) {
                    $this->collection->register(new RequestProfile($request, $response));
                    return $response;
                }, function ($reason) {
                    return $reason;
                });
            };
        };
    }
}
