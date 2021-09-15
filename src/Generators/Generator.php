<?php

namespace SchemaGenerate\StructureGenerate\Generators;

use SchemaGenerate\StructureGenerate\Data\Data;
use SchemaGenerate\StructureGenerate\Outputs\Output;
use SchemaGenerate\StructureGenerate\Parsers\ParserStructure;
use SchemaGenerate\StructureGenerate\Schemes\Schema;

interface Generator
{
    /**
     * @param ParserStructure $parserStructure
     * @return $this
     */
    public function setParserStructure(ParserStructure $parserStructure): self;

    /**
     * @param Output $output
     * @return $this
     */
    public function setOutput(Output $output): self;

    /**
     * @param Data $generateData
     * @return $this
     */
    public function setGenerateData(Data $generateData): self;

    /**
     * @param Schema $schemaStructure
     */
    public function process(Schema $schemaStructure): array;
}