<?php

namespace InviqaSprykerDebug\Tests\Acceptance\Context;

use Behat\Behat\Context\Context;
use Generated\Shared\Transfer\RabbitMqOptionTransfer;
use Spryker\Client\RabbitMq\RabbitMqClientInterface;

class QueueContext implements Context
{
    private $client;

    public function __construct(RabbitMqClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @Given the queue :arg1 exists
     */
    public function theQueueExists(string $queueName)
    {
        $options = new RabbitMqOptionTransfer();
        $this->client->createQueueAdapter()->createQueue($queueName, [
            'rabbitMqConsumerOption' => $options,
        ]);
    }
}
