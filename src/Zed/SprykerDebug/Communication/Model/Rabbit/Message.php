<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Model\Rabbit;

class Message
{
    /**
     * @var string
     */
    private $payload;

    public function __construct(string $payload)
    {
        $this->payload = $payload;
    }

    public function payload(): string
    {
        return $this->payload;
    }
}
