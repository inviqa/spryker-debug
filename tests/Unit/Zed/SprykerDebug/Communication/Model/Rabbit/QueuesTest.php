<?php

namespace Inviqa\SprykerDebug\Tests\Unit\Zed\SprykerDebug\Communication\Model\Rabbit;

use Inviqa\Zed\SprykerDebug\Communication\Model\Rabbit\Queue;
use Inviqa\Zed\SprykerDebug\Communication\Model\Rabbit\Queues;
use PHPUnit\Framework\TestCase;

class QueuesTest extends TestCase
{
    public function testReturnsQueueByVhosts()
    {
        $queues = new Queues(
            Queue::fromRabbitApiData([
                'vhost' => 'one',
            ]),
            Queue::fromRabbitApiData([
                'vhost' => 'one',
            ]),
            Queue::fromRabbitApiData([
                'vhost' => 'three',
            ]),
        );
        $this->assertCount(2, $queues->byVhost('one'));
        $this->assertCount(1, $queues->byVhost('three'));
        $this->assertCount(0, $queues->byVhost('four'));
    }
}
