<?php

use Spryker\Shared\RabbitMq\RabbitMqEnv;

$config[RabbitMqEnv::RABBITMQ_API_HOST] = 'localhost';
$config[RabbitMqEnv::RABBITMQ_API_PORT] = '16672';
$config[RabbitMqEnv::RABBITMQ_API_USERNAME] = 'guest';
$config[RabbitMqEnv::RABBITMQ_API_PASSWORD] = 'guest';
$config[RabbitMqEnv::RABBITMQ_API_VIRTUAL_HOST] = '/';
$config[RabbitMqEnv::RABBITMQ_CONNECTIONS] = [
    [
        RabbitMqEnv::RABBITMQ_CONNECTION_NAME => 'GB-connection',
        RabbitMqEnv::RABBITMQ_HOST => 'localhost',
        RabbitMqEnv::RABBITMQ_PORT => '57720',
        RabbitMqEnv::RABBITMQ_PASSWORD => 'guest',
        RabbitMqEnv::RABBITMQ_USERNAME => 'guest',
        RabbitMqEnv::RABBITMQ_VIRTUAL_HOST => '/',
        RabbitMqEnv::RABBITMQ_STORE_NAMES => ['GB'],
        RabbitMqEnv::RABBITMQ_DEFAULT_CONNECTION => true,
    ],
];
