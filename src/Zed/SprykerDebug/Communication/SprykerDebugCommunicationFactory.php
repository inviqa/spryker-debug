<?php

namespace Inviqa\Zed\SprykerDebug\Communication;

use GuzzleHttp\Client;
use Inviqa\Zed\SprykerDebug\Communication\Model\Rabbit\RabbitClient;
use Spryker\Shared\Config\Config;
use Spryker\Shared\RabbitMq\RabbitMqEnv;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class SprykerDebugCommunicationFactory extends AbstractCommunicationFactory
{
    public function getRabbitClient(): RabbitClient
    {
        return new RabbitClient(
            new Client([
                'base_uri' => sprintf(
                    'http://%s:%s/api',
                    Config::get(RabbitMqEnv::RABBITMQ_API_HOST),
                    Config::get(RabbitMqEnv::RABBITMQ_API_PORT),
                ),
                'auth' => [
                    Config::get(RabbitMqEnv::RABBITMQ_API_USERNAME),
                    Config::get(RabbitMqEnv::RABBITMQ_API_PASSWORD),
                ],
            ])
        );
    }
}
