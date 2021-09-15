<?php

namespace Tests\Parsers;

use Faker\Generator;
use NikitaSergeev\StructureGenerate\Parsers\ParserStructureJson;
use Tests\TestCase;

class ParserStructureJsonTest extends TestCase
{
    /** @var ParserStructureJson */
    private $parserStructure;

    protected function setUp(): void
    {
        parent::setUp();
        $this->parserStructure = new ParserStructureJson(new Generator());
    }

    public function testProcessEmpty(): void
    {
        $this->parserStructure->setSchema([]);
        $elements = $this->parserStructure->process([]);
        $this->assertIsArray($elements);
        $this->assertEquals([], $elements);
    }

    public function testProcessNotParse(): void
    {
        $this->parserStructure->setSchema([
            'foo' => 'bar'
        ]);
        $elements = $this->parserStructure->process([]);
        $this->assertIsArray($elements);
        $this->assertEquals([
            'foo' => 'bar'
        ], $elements);
    }

    public function testProcessParseProperty(): void
    {
        $mock = $this->createMock(Generator::class);
        $mock->method('__get')
            ->with('uuid')
            ->willReturn('123123123');

        $this->parserStructure = new ParserStructureJson($mock);
        $this->parserStructure->setSchema([
            'foo' => '{uuid}'
        ]);
        $elements = $this->parserStructure->process([]);
        $this->assertIsArray($elements);
        $this->assertEquals([
            'foo' => '123123123'
        ], $elements);
    }

    public function testProcessParseMethodWithParams(): void
    {
        $mock = $this->createMock(Generator::class);
        $mock->method('randomFloat')
            ->with(2, 1, 999)
            ->willReturn(24.5);

        $this->parserStructure = new ParserStructureJson($mock);
        $this->parserStructure->setSchema([
            'foo' => '{randomFloat([2, 1, 999])}'
        ]);
        $elements = $this->parserStructure->process([]);
        $this->assertIsArray($elements);
        $this->assertEquals([
            'foo' => '24.5'
        ], $elements);
    }

    public function testProcessParseWithParent(): void
    {
        $mock = $this->createMock(Generator::class);
        $mock->method('__call')
            ->with()
            ->willReturn('c7b3e357-d015-442b-b3b2-49f924dcca22');

        $this->parserStructure = new ParserStructureJson($mock);
        $this->parserStructure->setSchema([
            'foo' => '{data.foo}'
        ]);
        $elements = $this->parserStructure->process([
            'foo' => [
                'd9b86f45-775c-444d-969d-372560d78bde',
                'c7b3e357-d015-442b-b3b2-49f924dcca22'
            ]
        ]);
        $this->assertIsArray($elements);
        $this->assertEquals([
            'foo' => 'c7b3e357-d015-442b-b3b2-49f924dcca22'
        ], $elements);
    }
}
