<?php

namespace SchemaGenerate\StructureGenerate\Schemes;

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
     * @param int $default
     * @return int
     */
    public function getSettingCount(int|string $keySchema, int $default = 1): int;

    /**
     * @param int|string $keySchema
     * @return bool
     */
    public function isKey(int|string $keySchema): bool;

    /**
     * @param int|string $keySchema
     * @return mixed
     */
    public function getKey(int|string $keySchema): mixed;

    /**
     * @return array
     */
    public function getSettingOutput(): array;
}