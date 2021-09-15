<?php

namespace Tests\Outputs;

use NikitaSergeev\StructureGenerate\Data\GenerateData;
use NikitaSergeev\StructureGenerate\Outputs\OutputFileJson;
use Tests\TestCase;

class OutputFileJsonTest extends TestCase
{
    public function testProcessNotDirectory(): void
    {
        $mockData = $this->createMock(GenerateData::class);
        $mockData->method('get')->with('foo')->willReturn([
            'foo' => 'bar'
        ]);

        $outputFileJson = new OutputFileJson();
        $outputFileJson->setData($mockData);
        $outputFileJson->setSettings([
            'foo' => 'bar'
        ]);
        $this->expectError();
        $outputFileJson->process();
    }

    public function testProcess(): void
    {
        $mockData = $this->createMock(GenerateData::class);
        $mockData->method('get')->with('foo')->willReturn([
            'foo' => 'bar'
        ]);

        $outputFileJson = new OutputFileJson();
        $outputFileJson->setData($mockData);
        $outputFileJson->setSettings([
            'foo' => '/tmp/asd12321dsda.json'
        ]);
        $result = $outputFileJson->process();
        $this->assertEquals([
            'foo' => '/tmp/asd12321dsda.json'
        ], $result);

        $this->assertFileExists('/tmp/asd12321dsda.json');
    }
}
