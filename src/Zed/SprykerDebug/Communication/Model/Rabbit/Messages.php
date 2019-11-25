<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Model\Rabbit;

use ArrayIterator;
use Iterator;
use IteratorAggregate;

final class Messages implements IteratorAggregate
{
    private $messages = [];

    public function __construct(array $messages)
    {
        foreach ($messages as $message) {
            $this->add($message);
        }
    }

    private function add(Message $message): void
    {
        $this->messages[] = $message;
    }

    public function getIterator(): Iterator
    {
        return new ArrayIterator($this->messages);
    }
}
