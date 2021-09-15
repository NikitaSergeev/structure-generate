<?php

namespace NikitaSergeev\StructureGenerate\Outputs;

use NikitaSergeev\StructureGenerate\Data\GenerateData;

abstract class OutputAbstract implements Output
{
    /**
     * @var GenerateData
     */
    protected $data;

    /**
     * @var array
     */
    protected $settings;

    public function setData(GenerateData $data): Output
    {
        $this->data = $data;
        return $this;
    }

    public function setSettings(array $settings): Output
    {
        $this->settings = $settings;
        return $this;
    }
}