<?php

namespace SchemaGenerate\StructureGenerate\Data;

interface Data
{
    /**
     * @param string $keySchema
     * @param array $data
     */
    public function set(string $keySchema, array $data): void;

    /**
     * @param string $key
     * @return array
     */
    public function get(string $key): array;
}