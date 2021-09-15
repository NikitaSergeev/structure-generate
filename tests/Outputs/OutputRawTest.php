<?php

namespace Tests\Outputs;

use SchemaGenerate\StructureGenerate\Data\GenerateData;
use SchemaGenerate\StructureGenerate\Outputs\OutputRaw;
use Tests\TestCase;

class OutputRawTest extends TestCase
{
    public function testProcess(): void
    {
        $mockData = $this->createMock(GenerateData::class);
        $mockData->method('get')->willReturn(['foo' => 'bar']);

        $outputRaw = new OutputRaw();
        $outputRaw->setData($mockData);
        $result = $outputRaw->process();
        $this->assertEquals([
            'foo' => 'bar'
        ], $result);
    }
}
