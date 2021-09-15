<?php

namespace NikitaSergeev\StructureGenerate\Outputs;

use NikitaSergeev\StructureGenerate\Data\GenerateData;

interface Output
{
    /**
     * @param GenerateData $data
     * @return $this
     */
    public function setData(GenerateData $data): self;

    /**
     * @param array $settings
     * @return $this
     */
    public function setSettings(array $settings): self;

    /**
     * @return array
     */
    public function process(): array;
}