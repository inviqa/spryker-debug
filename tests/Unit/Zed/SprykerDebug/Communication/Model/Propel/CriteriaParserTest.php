<?php

namespace Inviqa\SprykerDebug\Tests\Unit\Zed\SprykerDebug\Communication\Model\Propel;

use Inviqa\Zed\SprykerDebug\Communication\Model\Propel\CriteriaParser;
use PHPUnit\Framework\TestCase;

class CriteriaParserTest extends TestCase
{
    /**
     * @dataProvider provideParseCriteria
     */
    public function testParseCriteria(string $criteria, array $expected)
    {
        self::assertEquals($expected, (new CriteriaParser())->parse($criteria));
    }

    public function provideParseCriteria()
    {
        yield 'empty' => [
            '',
            []
        ];

        yield 'no value' => [
            'Name',
            [
                'Name' => null,
            ]
        ];

        yield 'value' => [
            'Name:Value',
            [
                'Name' => 'Value',
            ]
        ];
    }
}
