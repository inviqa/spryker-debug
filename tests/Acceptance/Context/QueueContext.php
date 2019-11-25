<?php

namespace Inviqa\SprykerDebug\Tests\Acceptance\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Generated\Shared\Transfer\QueueSendMessageTransfer;
use Generated\Shared\Transfer\RabbitMqOptionTransfer;
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Spryker\Client\RabbitMq\RabbitMqClientInterface;

class QueueContext implements Context
{
    /**
     * @var AMQPConnection
     */
    private $connection;


    public function __construct(AMQPConnection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @Given the queue :arg1 exists
     */
    public function theQueueExists(string $queueName)
    {
        $channel = $this->connection->channel();
        $channel->queue_delete($queueName);
        $channel->queue_declare($queueName);
    }

    /**
     * @When I add the following message to queue :arg1:
     */
    public function addTheFollowingMessageToQueue(string $queueName, PyStringNode $message)
    {
        $channel = $this->connection->channel();
        $message = new AMQPMessage($message->getRaw());
        $channel->basic_publish($message, '', $queueName);
    }
}
