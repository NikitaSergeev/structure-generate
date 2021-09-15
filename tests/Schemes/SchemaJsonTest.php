<?php

namespace Tests\Schemes;

use  SchemaGenerate\StructureGenerate\Schemes\SchemaJson;
use Tests\TestCase;

class SchemaJsonTest extends TestCase
{

    public function testSetAndGetData(): void
    {
        $schemaJson = new SchemaJson();
        $schemaJson->setData(['data']);
        $this->assertIsArray($schemaJson->getData());
    }

    public function testGetDataError(): void
    {
        $schemaJson = new SchemaJson();
        $this->expectError();
        $schemaJson->getData();
    }

    public function testGetSettingOutputError(): void
    {
        $schemaJson = new SchemaJson();
        $schemaJson->setData([
            'settings' => [
                'asdasd'
            ],
        ]);
        $this->expectError();
        $schemaJson->getSettingOutput();
    }

    public function testGetSettingOutput(): void
    {
        $schemaJson = new SchemaJson();
        $schemaJson->setData([
            'settings' => [
                'output' => [
                    'one' => 1,
                    'two' => 2
                ]
            ],
        ]);
        $outputs = $schemaJson->getSettingOutput();
        $this->assertIsArray($outputs);
        $this->assertEquals([
            'one' => 1,
            'two' => 2
        ], $outputs);
    }

    public function testGetSchemaError(): void
    {
        $schemaJson = new SchemaJson();
        $this->expectError();
        $schemaJson->getSchema();
    }

    public function testGetSchema(): void
    {
        $schemaJson = new SchemaJson();
        $schemaJson->setData([
            'schema' => [
                'one' => [
                    'one' => 1,
                ],
                'two' => [
                    'two' => 2
                ]
            ],
        ]);

        $schema = $schemaJson->getSchema();
        $this->assertIsArray($schema);
        $this->assertEquals([
            'one' => [
                'one' => 1
            ],
            'two' => [
                'two' => 2
            ]
        ], $schema);
    }

    public function testGetKeyError(): void
    {
        $schemaJson = new SchemaJson();
        $this->expectError();
        $schemaJson->getKey('asd');
    }

    public function testGetKey(): void
    {
        $schemaJson = new SchemaJson();
        $schemaJson->setData([
            'keys' => [
                'one' => [
                    'one' => 1,
                ],
                'two' => [
                    'two' => 2
                ]
            ],
        ]);

        $one = $schemaJson->getKey('one');
        $this->assertIsArray($one);
        $this->assertEquals([
            'one' => 1
        ], $one);
    }

    public function testGetSettingCountDefaultOne(): void
    {
        $schemaJson = new SchemaJson();
        $one = $schemaJson->getSettingCount('foo');
        $this->assertEquals(1, $one);
    }

    public function testGetSettingCountDefault(): void
    {
        $schemaJson = new SchemaJson();
        $count = $schemaJson->getSettingCount('foo', 5);
        $this->assertEquals(5, $count);
    }

    public function testGetSettingCount(): void
    {
        $schemaJson = new SchemaJson();
        $schemaJson->setData([
            'settings' => [
                'counts' => [
                    'one' => 1,
                    'two' => 2
                ],
            ]
        ]);

        $two = $schemaJson->getSettingCount('two');
        $this->assertEquals(2, $two);
    }
}
