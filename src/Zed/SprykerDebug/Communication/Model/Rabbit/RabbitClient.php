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
        }, $this->get('queues')));
    }

    private function get(string $url): array
    {
        $decoded = json_decode(
            $this->client->request(
                'GET',
                sprintf('/api/%s', $url)
            )->getBody()->__toString(),
            true
        );

        if ($decoded === false) {
            throw new RuntimeException(sprintf('Could not decode JSON response "%s"', json_last_error_msg()));
        }

        return $decoded;
    }

    private function post(string $url, array $options): array
    {
        $decoded = json_decode(
            $this->client->request(
                'POST',
                sprintf('/api/%s', $url),
                [
                    'json' => $options,
                ]
            )->getBody()->__toString(),
            true
        );

        if ($decoded === false) {
            throw new RuntimeException(sprintf('Could not decode JSON response "%s"', json_last_error_msg()));
        }

        return $decoded;
    }

    public function peek(string $vhost, string $queue, int $limit): Messages
    {
        $response = $this->post(sprintf('queues/%s/%s/get', $vhost, $queue), [
            'count' => $limit,
            'ackmode' => 'ack_requeue_true',
            'encoding' => 'auto',
        ]);

        return new Messages(array_map(function ($record) {
            return new Message($record['payload']);
        }, $response));
    }
}
