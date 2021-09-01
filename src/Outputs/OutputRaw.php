<?php

namespace SchemaGenerate\StructureGenerate\Outputs;

use SchemaGenerate\StructureGenerate\Data\GenerateData;

class OutputRaw extends OutputAbstract
{
    public function process(): array
    {
        return $this->data->get();
    }
}