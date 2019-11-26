<?php

namespace Inviqa\Shared\SprykerDebug\Plugin\Guzzle;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class RequestProfile
{
    /**
     * @var RequestInterface
     */
    private $request;
    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function request(): RequestInterface
    {
        return $this->request;
    }

    public function response(): ResponseInterface
    {
        return $this->response;
    }
}
