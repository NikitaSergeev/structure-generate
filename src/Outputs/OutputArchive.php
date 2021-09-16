<?php

namespace SchemaGenerate\StructureGenerate\Outputs;

use ZipArchive;

class OutputArchive extends OutputAbstract
{
    /** @var Output */
    private $output;

    public function __construct(Output $output)
    {
        $this->output = $output;
    }

    public function process(): array
    {
        $result = $this->output->process();

        $zip = new ZipArchive();
        $filePath = '/tmp/' . time() . '.zip';
        $zip->open($filePath, ZipArchive::CREATE);

        foreach ($result as $file) {
            $zip->addFile($file);
        }
        $zip->close();

        return [
            $filePath
        ];
    }
}