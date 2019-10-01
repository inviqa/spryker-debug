<?php

namespace Inviqa\Spryker\Debug\Tests\Unit\Shared\Config;

use Inviqa\Spryker\Debug\Shared\Config\ArrayLoader;
use Inviqa\Spryker\Debug\Shared\Config\Exception\InvalidConfigException;
use PHPUnit\Framework\TestCase;

class ArrayLoaderTest extends TestCase
{
    const EXAMPLE_KEY = 'key';

    /**
     * @dataProvider provideLoad
     */
    public function testLoad(array $config, array $expectedConfig)
    {
        $this->assertEquals($expectedConfig, ArrayLoader::create()->load($config));
    }

    public function provideLoad()
    {
        yield 'from fully qualified constant name' => [
            [
                'Inviqa' => [
                    'Spryker' => [
                        'Debug' => [
                            'Tests' => [
                                'Unit' => [
                                    'Shared' => [
                                        'Config' => [
                                            'ArrayLoaderTest' => [
                                                'EXAMPLE_KEY' => 123
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                'key' => 123
            ]
        ];

        yield 'from fully qualified constant name with array value' => [
            [
                'Inviqa' => [
                    'Spryker' => [
                        'Debug' => [
                            'Tests' => [
                                'Unit' => [
                                    'Shared' => [
                                        'Config' => [
                                            'ArrayLoaderTest' => [
                                                'EXAMPLE_KEY' => [
                                                    'FOO' => 'BAR'
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                'key' => [
                    'FOO' => 'BAR',
                ],
            ]
        ];
    }

    public function testThrowsExceptionIfKeyConstantDoesNotExist()
    {
        $this->expectException(InvalidConfigException::class);

        ArrayLoader::create()->load([
            'FOO' => [
                'BAR' => 'BOO'
            ]
        ]);
    }

    public function testThrowsExceptionConfigIsTopLevelOnly()
    {
        $this->expectException(InvalidConfigException::class);

        ArrayLoader::create()->load([
            'FOO' => 'BAR',
        ]);
    }
}
