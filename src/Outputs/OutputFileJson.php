<?php

namespace SchemaGenerate\StructureGenerate\Outputs;

class OutputFileJson extends OutputAbstract
{
    public function process(): array
    {
        foreach ($this->settings as $key => $filePath) {
            $concurrentDirectory = str_replace(basename($filePath), '', $filePath);
            if (!is_dir($concurrentDirectory) && !mkdir($concurrentDirectory, 0777, true)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }

            file_put_contents($filePath, json_encode($this->data->get($key)));
        }
        return $this->settings;
    }
}