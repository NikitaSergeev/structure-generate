<?php

namespace  SchemaGenerate\StructureGenerate\Outputs;

class OutputRaw extends OutputAbstract
{
    public function process(): array
    {
        return $this->data->get();
    }
}