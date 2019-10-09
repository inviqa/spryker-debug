<?php

namespace Inviqa\Zed\SprykerDebug\Communication\Model\Rabbit;

use GuzzleHttp\Client;
use RuntimeException;

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
        $decoded = json_decode(
            $this->client->request(
                'GET',
                sprintf('/api/%s', $url)
            )->getBody()->__toString(),
            true
        );

        if (false === $decoded) {
            throw new RuntimeException(sprintf('Could not decode JSON response "%s"', json_last_error_msg()));
        }

        return $decoded;
    }
}
