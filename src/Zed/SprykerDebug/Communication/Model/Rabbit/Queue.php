<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Model\Rabbit;

class Queue
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $state;

    /**
     * @var int
     */
    private $readyMessages;

    /**
     * @var int
     */
    private $unackedMessages;

    /**
     * @var int
     */
    private $totalMessages;

    /**
     * @var string
     */
    private $vhost;

    public function __construct(
        string $name,
        string $state,
        int $readyMessages,
        int $unackedMessages,
        int $totalMessages,
        string $vhost
    ) {
        $this->name = $name;
        $this->state = $state;
        $this->readyMessages = $readyMessages;
        $this->unackedMessages = $unackedMessages;
        $this->totalMessages = $totalMessages;
        $this->vhost = $vhost;
    }

    public static function fromRabbitApiData(array $data): self
    {
        $state = isset($data['idle_since']) ? 'idle' : $data['state'] ?? '';
        return new self(
            $data['name'],
            $state,
            $data['messages_ready'] ?? -1,
            $data['messages_unacknowledged'] ?? -1,
            $data['messages'] ?? -1,
            $data['vhost'] ?? ''
        );
    }

    public function name(): string
    {
        return $this->name;
    }

    public function readyMessages(): int
    {
        return $this->readyMessages;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function totalMessages(): int
    {
        return $this->totalMessages;
    }

    public function unackedMessages(): int
    {
        return $this->unackedMessages;
    }

    public function vhost(): string
    {
        return $this->vhost;
    }
}
