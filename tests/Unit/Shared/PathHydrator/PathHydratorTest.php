<?php

namespace InviqaSprykerDebug\Tests\Unit\Shared\PathHydrator;

use Exception;
use InviqaSprykerDebug\Shared\PathHydrator\PathHydrator;
use InviqaSprykerDebug\Tests\Unit\Shared\PathHydrator\Example\ExampleClass;
use PHPUnit\Framework\TestCase;

class PathHydratorTest extends TestCase
{
    public function testHydratesAnObjectFromPaths()
    {
        $example = new ExampleClass();
        $example->object = new ExampleClass();

        PathHydrator::create()->hydrate($example, [
            'scalar' => 'one',
            'object.scalar' => 'two',
        ]);

        $this->assertEquals('one', $example->scalar);
        $this->assertEquals('two', $example->object->scalar);
    }

    public function testHydratesWithJsonValues()
    {
        $example = new ExampleClass();
        $example->object = new ExampleClass();

        PathHydrator::create()->hydrateFromJsonValues($example, [
            'array' => '["one","two"]',
            'object.scalar' => '"two"',
        ]);

        $this->assertEquals(['one', 'two'], $example->array);
        $this->assertEquals('two', $example->object->scalar);
    }

    public function testThrowsExceptionIfPathDoesNotExist()
    {
        $this->expectException(Exception::class);

        $example = new ExampleClass();
        $example->object = new ExampleClass();

        PathHydrator::create()->hydrate($example, [
            'object.nope' => 'two',
        ]);
    }
}
