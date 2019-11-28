<?php

namespace Inviqa\SprykerDebug\Tests\Unit\Zed\SprykerDebug\Communication\Model\Propel;

use Inviqa\Zed\SprykerDebug\Communication\Model\Propel\FieldParser;
use PHPUnit\Framework\TestCase;

class FieldParserTest extends TestCase
{
    /**
     * @dataProvider provideParseFields
     */
    public function testParseFields(string $fields, array $expected)
    {
        self::assertEquals($expected, (new FieldParser())->parse($fields));
    }

    public function provideParseFields()
    {
        yield 'empty' => [
            '',
            []
        ];

        yield 'whitepsace' => [
            '  ',
            []
        ];

        yield 'single' => [
            'foobar',
            ['foobar']
        ];

        yield 'multiple' => [
            'foobar,barfoo',
            ['foobar', 'barfoo']
        ];

        yield 'multiple with whitepsaces' => [
            '  foobar  ,barfoo ',
            ['foobar', 'barfoo']
        ];
    }
}
