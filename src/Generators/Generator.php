<?php

namespace NikitaSergeev\StructureGenerate\Generators;

use NikitaSergeev\StructureGenerate\Data\Data;
use NikitaSergeev\StructureGenerate\Outputs\Output;
use NikitaSergeev\StructureGenerate\Parsers\ParserStructure;
use NikitaSergeev\StructureGenerate\Schemes\Schema;

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