<?php

namespace  SchemaGenerate\StructureGenerate\Schemes;

interface Schema
{
    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data): self;

    /**
     * @return array
     */
    public function getData(): array;

    /**
     * @return array
     */
    public function getSchema(): array;

    /**
     * @param int|string $keySchema
     * @param mixed $default
     * @return int
     */
    public function getSettingCount($keySchema, int $default = 1): int;

    /**
     * @param mixed $keySchema
     * @return bool
     */
    public function isKey($keySchema): bool;

    /**
     * @param mixed $keySchema
     * @return mixed
     */
    public function getKey($keySchema): mixed;

    /**
     * @return array
     */
    public function getSettingOutput(): array;
}
