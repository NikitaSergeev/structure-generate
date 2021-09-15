<?php

namespace NikitaSergeev\StructureGenerate\Generators;

use NikitaSergeev\StructureGenerate\Data\Data;
use NikitaSergeev\StructureGenerate\Data\GenerateData;
use NikitaSergeev\StructureGenerate\Outputs\Output;
use NikitaSergeev\StructureGenerate\Outputs\OutputRaw;
use NikitaSergeev\StructureGenerate\Parsers\ParserStructure;
use NikitaSergeev\StructureGenerate\Schemes\Schema;

class GeneratorService implements Generator
{
    /**
     * @var ParserStructure
     */
    private $parserStructure;

    /**
     * @var Output
     */
    private $output;

    /**
     * @var GenerateData
     */
    private $generateData;

    /**
     * @var array
     */
    private $keysIndex = [];

    public function __construct(ParserStructure $generateObject, Output $output = null, Data $generateData = null)
    {
        $this->setParserStructure($generateObject);
        $this->setOutput($output ?? new OutputRaw());
        $this->setGenerateData($generateData ?? new GenerateData());
    }

    public function setParserStructure(ParserStructure $parserStructure): Generator
    {
        $this->parserStructure = $parserStructure;
        return $this;
    }

    public function setOutput(Output $output): Generator
    {
        $this->output = $output;
        return $this;
    }

    public function setGenerateData(Data $generateData): Generator
    {
        $this->generateData = $generateData;
        return $this;
    }

    public function process(Schema $schemaStructure): array
    {
        foreach ($schemaStructure->getSchema() as $keySchema => $schema) {
            $this->parserStructure->setSchema($schema);
            for ($i = 0; $i < $schemaStructure->getSettingCount($keySchema); $i++) {
                $this->generateData->set(
                    $keySchema,
                    $this->parserStructure->process($this->keysIndex)
                );
            }

            if ($schemaStructure->isKey($keySchema)) {
                $this->keysIndex[$keySchema] = array_column(
                    $this->generateData->get($keySchema),
                    $schemaStructure->getKey($keySchema)
                );
            }
        }

        return $this->output->setData($this->generateData)
            ->setSettings($schemaStructure->getSettingOutput())
            ->process();
    }
}
