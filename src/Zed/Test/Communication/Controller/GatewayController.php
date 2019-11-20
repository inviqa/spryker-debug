<?php

namespace Inviqa\Zed\Test\Communication\Controller;

use Generated\Shared\Transfer\TestTransfer;
use Spryker\Shared\ZedRequest\Client\ResponseInterface;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GatewayController extends AbstractGatewayController
{
    public function helloWorldAction()
    {
        return new JsonResponse([
            ResponseInterface::TRANSFER_CLASSNAME => TestTransfer::class,
            ResponseInterface::TRANSFER => [],
        ]);
    }
}
