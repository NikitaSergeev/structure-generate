<?php

namespace SchemaGenerate\StructureGenerate\Schemes;

class SchemaJson implements Schema
{
    private array $data;

    public function setData(array $json): Schema
    {
        $this->data = $json;
        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getSchema(): array
    {
        return $this->data['schema'];
    }

    public function getSettingCount(int|string $keySchema, int $default = 1): int
    {
        return $this->data['settings']['counts'][$keySchema] ?? $default;
    }

    public function isKey(int|string $keySchema): bool
    {
        return isset($this->data['keys'][$keySchema]);
    }

    public function getKey(int|string $keySchema): mixed
    {
        return $this->data['keys'][$keySchema];
    }

    public function getSettingOutput(): array
    {
        return $this->data['settings']['output'];
    }
}