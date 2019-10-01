<?php

use Propel\Generator\Builder\Om\ObjectBuilder;
use Propel\Generator\Builder\Om\QueryBuilder;
use Spryker\Shared\Propel\PropelConstants;
use Spryker\Zed\Propel\PropelConfig;


$config[PropelConstants::ZED_DB_USERNAME] = 'spryker_debug_test';
$config[PropelConstants::ZED_DB_PASSWORD] = 'spryker_debug_test';
$config[PropelConstants::ZED_DB_HOST] = 'localhost';
$config[PropelConstants::ZED_DB_PORT] = '5432';
$config[PropelConstants::ZED_DB_DATABASE] = 'spryker_debug_test';
$config[PropelConstants::ZED_DB_ENGINE] = 'pgsql';

$DSN = sprintf(
    '%s:host=%s;port=%d;dbname=%s',
    $config[PropelConstants::ZED_DB_ENGINE],
    $config[PropelConstants::ZED_DB_HOST],
    $config[PropelConstants::ZED_DB_PORT],
    $config[PropelConstants::ZED_DB_DATABASE]
);

$connections = [
    'pgsql' => [
        'adapter' => PropelConfig::DB_ENGINE_PGSQL,
        'dsn' => $DSN,
        'user' => $config[PropelConstants::ZED_DB_USERNAME],
        'password' => $config[PropelConstants::ZED_DB_PASSWORD],
        'settings' => [],
    ],
];

$config[PropelConstants::PROPEL] = [
    'database' => [
        'connections' => [],
    ],
    'runtime' => [
        'defaultConnection' => 'default',
        'connections' => ['default', 'zed'],
    ],
    'generator' => [
        'defaultConnection' => 'default',
        'connections' => ['default', 'zed'],
        'objectModel' => [
            'defaultKeyType' => 'fieldName',
            'builders' => [
                // If you need full entity logging on Create/Update/Delete, then switch to
                // Spryker\Zed\PropelOrm\Business\Builder\ObjectBuilderWithLogger instead.
                'object' => ObjectBuilder::class,
                'query' => QueryBuilder::class,
            ],
        ],
    ],
    'paths' => [
        'phpDir' => APPLICATION_ROOT_DIR,
        'sqlDir' => APPLICATION_ROOT_DIR . '/src/Orm/Propel/Sql',
        'migrationDir' => APPLICATION_ROOT_DIR . '/src/Orm/Propel/Migration_' . $config[PropelConstants::ZED_DB_ENGINE],
        'schemaDir' => APPLICATION_ROOT_DIR . '/Orm/Propel/Schema',
        'phpConfDir' => APPLICATION_ROOT_DIR . '/src/Orm/Propel/Config/' . APPLICATION_ENV . '/',
    ],
];

$ENGINE = $config[PropelConstants::ZED_DB_ENGINE];
$config[PropelConstants::PROPEL]['database']['connections']['default'] = $connections[$ENGINE];
$config[PropelConstants::PROPEL]['database']['connections']['zed'] = $connections[$ENGINE];
