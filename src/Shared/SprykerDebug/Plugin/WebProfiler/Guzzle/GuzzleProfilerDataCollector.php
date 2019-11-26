<?php

namespace Inviqa\Shared\SprykerDebug\Plugin\WebProfiler\Guzzle;

use Inviqa\Shared\SprykerDebug\Plugin\Guzzle\RequestCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;

class GuzzleProfilerDataCollector extends DataCollector implements DataCollectorInterface
{
    /**
     * @var RequestCollection
     */
    private $requestCollection;

    public function __construct(RequestCollection $requestCollection)
    {
        $this->requestCollection = $requestCollection;
    }

    /**
     * {@inheritDoc}
     */
    public function collect(Request $request, Response $response)
    {
        $this->data = $this->requestCollection->toArray();
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'Guzzle Profiler';
    }

    public function reset()
    {
        $this->data = [];
    }
}
