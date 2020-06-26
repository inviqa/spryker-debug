<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Model\Rabbit;

use ArrayIterator;
use Countable;
use IteratorAggregate;

class Queues implements IteratorAggregate, Countable
{
    /**
     * @var array
     */
    private $queues;

    public function __construct(Queue ...$queues)
    {
        $this->queues = $queues;
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->queues);
    }

    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        return count($this->queues);
    }

    public function byVhost(string ...$vhosts): self
    {
        return new self(...array_filter($this->queues, function (Queue $queue) use ($vhosts) {
            return in_array($queue->vhost(), $vhosts);
        }));
    }

    public function filterByString(string $string): self
    {
        return new self(...array_filter($this->queues, function (Queue $queue) use ($string) {
            return preg_match(sprintf('{.*%s.*}', $string), $queue->name());
        }));
    }

    public function names(): array
    {
        return array_map(function (Queue $queue) {
            return $queue->name();
        }, $this->queues);
    }

    public function nonEmpty(): self
    {
        return new self(...array_filter($this->queues, function (Queue $queue) {
            return $queue->totalMessages() > 0;
        }));
    }
}
