<?php

namespace Pyz\Client\Test\Zed;

use Generated\Shared\Transfer\TestTransfer;
use Spryker\Client\ZedRequest\ZedRequestClient;

class TestStub
{
    /**
     * @var ZedRequestClient
     */
    private $client;

    public function __construct(ZedRequestClient $client)
    {
        $this->client = $client;
    }


    public function testHelloWorld(TestTransfer $transfer): void
    {
        $this->client->call('/test/gateway/hello-world', $transfer);
    }
}
