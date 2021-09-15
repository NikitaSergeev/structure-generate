<?php

namespace NikitaSergeev\StructureGenerate\Parsers;

use Faker\Generator;

class ParserStructureJson implements ParserStructure
{
    /**
     * @var array
     */
    private $schema;

    /**
     * @var Generator
     */
    private $faker;

    public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }

    public function setSchema(array $schema): ParserStructure
    {
        $this->schema = $schema;
        return $this;
    }

    public function process(array $keysIndex): array
    {
        $el = [];
        foreach ($this->schema as $key => $value) {
            if (preg_match('/{.+}/', $value)) {
                if (preg_match('/{data\.(.+)}/s', $value, $matches)) {
                    $el[$key] = $this->faker->randomElement($keysIndex[$matches[1]]);
                    continue;
                }

                $method = str_replace(['{', '}'], '', $value);
                $re = '/{(.*)\((.*)\)}/s';
                $str = $value;

                preg_match_all($re, $str, $matches, PREG_SET_ORDER);

                if ($matches === []) {
                    $el[$key] = $this->faker->{$method};
                    continue;
                }

                $method = $matches[0][1];
                $params = json_decode($matches[0][2], true);
                $el[$key] = $this->faker->{$method}(...$params);
                continue;
            }

            $el[$key] = $value;
        }

        return $el;
    }
}