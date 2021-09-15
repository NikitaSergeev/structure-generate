<?php

namespace Tests\Data;

use  SchemaGenerate\StructureGenerate\Data\GenerateData;
use Tests\TestCase;

class GenerateDataTest extends TestCase
{
    public function testGet(): void
    {
        $data = new GenerateData();
        $data->set('foo', ['foo' => 'bar']);
        $this->assertEquals([
            'foo' => [
                [
                    'foo' => 'bar'
                ]
            ]
        ], $data->get());

        $this->assertEquals([
            ['foo' => 'bar']
        ], $data->get('foo'));

        $this->assertEquals([
            'foo' => [
                [
                    'foo' => 'bar'
                ]
            ]
        ], $data->get('zxc'));
    }
}
