<?php

namespace Tests\Generators;

use  SchemaGenerate\StructureGenerate\Data\GenerateData;
use  SchemaGenerate\StructureGenerate\Generators\GeneratorService;
use  SchemaGenerate\StructureGenerate\Outputs\Output;
use  SchemaGenerate\StructureGenerate\Parsers\ParserStructure;
use  SchemaGenerate\StructureGenerate\Schemes\Schema;
use Tests\TestCase;

class GeneratorServiceTest extends TestCase
{
    public function testProcessError(): void
    {
        $mockParserStructure = $this->createMock(ParserStructure::class);
        $this->expectError();

        $generate = new GeneratorService($mockParserStructure);
        $generate->process($mockParserStructure);
    }

    public function testProcessEmpty(): void
    {
        $mockParserStructure = $this->createMock(ParserStructure::class);
        $mockSchemaStructure = $this->createMock(Schema::class);

        $result = (new GeneratorService($mockParserStructure))
            ->process($mockSchemaStructure);

        $this->assertIsArray($result);
        $this->assertEquals([], $result);
    }

    public function testProcessWithGenerateData(): void
    {
        $mockParserStructure = $this->createMock(ParserStructure::class);
        $mockSchemaStructure = $this->createMock(Schema::class);
        $mockGenerateData = $this->createMock(GenerateData::class);
        $mockGenerateData->method('get')->willReturn(['foo' => ['bar']]);

        $result = (new GeneratorService($mockParserStructure))
            ->setGenerateData($mockGenerateData)
            ->process($mockSchemaStructure);

        $this->assertIsArray($result);
        $this->assertEquals([
            'foo' => [
                'bar'
            ]
        ], $result);
    }

    public function testProcessWithOutput(): void
    {
        $mockParserStructure = $this->createMock(ParserStructure::class);
        $mockSchemaStructure = $this->createMock(Schema::class);
        $mockGenerateData = $this->createMock(GenerateData::class);
        $mockOutput = $this->createMock(Output::class);

        $mockOutput->method('setData')->willReturn($mockOutput);
        $mockOutput->method('setSettings')->willReturn($mockOutput);
        $mockOutput->method('process')->willReturn(['foo' => 'bar']);

        $result = (new GeneratorService($mockParserStructure))
            ->setGenerateData($mockGenerateData)
            ->setOutput($mockOutput)
            ->process($mockSchemaStructure);

        $this->assertIsArray($result);
        $this->assertEquals([
            'foo' => 'bar'
        ], $result);
    }
}
