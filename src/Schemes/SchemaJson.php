<?php

namespace  SchemaGenerate\StructureGenerate\Schemes;

class SchemaJson implements Schema
{
    private array $data;

    public function setData(array $data): Schema
    {
        $this->data = $data;
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

    public function getSettingCount($keySchema, int $default = 1): int
    {
        return $this->data['settings']['counts'][$keySchema] ?? $default;
    }

    public function isKey($keySchema): bool
    {
        return isset($this->data['keys'][$keySchema]);
    }

    public function getKey($keySchema): mixed
    {
        return $this->data['keys'][$keySchema];
    }

    public function getSettingOutput(): array
    {
        return $this->data['settings']['output'];
    }
}
