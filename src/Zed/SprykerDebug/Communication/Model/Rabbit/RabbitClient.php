<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Model\Rabbit;

use GuzzleHttp\Client;

final class RabbitClient
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Queues<Queue>
     */
    public function queues(): Queues
    {
        return new Queues(...array_map(function (array $data) {
            return Queue::fromRabbitApiData($data);
        }, $this->request('queues')));
    }

    private function request(string $url): array
    {
        return json_decode(
            $this->client->request(
                'GET',
                sprintf('/api/%s', $url)
            )->getBody()->__toString(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );
    }
}
