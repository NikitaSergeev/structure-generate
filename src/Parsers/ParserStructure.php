<?php

namespace  SchemaGenerate\StructureGenerate\Parsers;

interface ParserStructure
{
    /**
     * @param array $schema
     * @return $this
     */
    public function setSchema(array $schema): self;

    /**
     * @param array $keysIndex
     * @return array
     */
    public function process(array $keysIndex): array;
}