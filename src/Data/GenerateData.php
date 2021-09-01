<?php

namespace SchemaGenerate\StructureGenerate\Data;

class GenerateData implements Data
{
    /**
     * @var array
     */
    private $data = [];

    public function set(string $keySchema, array $data): void
    {
        $this->data[$keySchema][] = $data;
    }

    public function get(string $key = null): array
    {
        return $this->data[$key] ?? $this->data;
    }
}