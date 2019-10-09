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

    /**
     * @dataProvider provideFilterByString
     */
    public function testFilterByString(Queues $queues, string $string, array $expectedQueueNames)
    {
        $this->assertEquals($expectedQueueNames, $queues->filterByString($string)->names());
    }

    public function provideFilterByString()
    {
        yield 'empty' => [
            new Queues(
                $this->createQueue('one'),
                $this->createQueue('two'),
            ),
            '',
            [
                'one',
                'two',
            ]
        ];

        yield 'no match' => [
            new Queues(
                $this->createQueue('one'),
                $this->createQueue('two'),
            ),
            'asdasdads',
            [
            ]
        ];

        yield 'exact match 1' => [
            new Queues(
                $this->createQueue('one'),
                $this->createQueue('two'),
            ),
            'two',
            [
                'two',
            ]
        ];

        yield 'partial match 1' => [
            new Queues(
                $this->createQueue('one'),
                $this->createQueue('two'),
            ),
            'on',
            [
                'one',
            ]
        ];
    }

    private function createQueue(string $string)
    {
        return Queue::fromRabbitApiData(['name' => $string]);
    }
}
