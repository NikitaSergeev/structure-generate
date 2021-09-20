## Генерирует связанные данные

[![PHP Composer](https://github.com/NikitaSergeev/structure-generate/actions/workflows/php.yml/badge.svg)](https://github.com/NikitaSergeev/structure-generate/actions/workflows/php.yml)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/NikitaSergeev/structure-generate/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/NikitaSergeev/structure-generate/?branch=main)

Генерирует рандомные данные из шаблона

## Установка

``comoposer req nikitasergeev/structure-generate``

## Пример Json данных

```php

$template = json_decode('
    {
  "settings": {
    "counts": {
      "products": 10000
    },
    "output": {
      "products": "/tmp/products.json"
    }
  },
  "keys": {
    "products": "guid",
    "categories": "guid"
  },
  "schema": {
    "categories": {
      "guid": "{uuid}",
      "name": "{word}"
    },
    "products": {
      "guid": "{uuid}",
      "category_guid": "{data.categories}",
      "sku": "{word}",
      "name": "{name}",
      "packing": "{word}",
      "link_image": "{randomElement([[\"http://nginx/uploads/image-1.jpg\",\"http://nginx/uploads/image-2.jpg\",\"http://nginx/uploads/image-3.jpg\"]])}",
      "count_packing": "{randomNumber([1])}",
      "unit": "{word}",
      "stock": "{randomNumber([1])}",
      "is_deleted": false
    }
  }
}', true);

$parserStructureJson = new \SchemaGenerate\StructureGenerate\Parsers\ParserStructureJson(Faker\Factory::create());
$outputFileJson = new \SchemaGenerate\StructureGenerate\Outputs\OutputFileJson();
$schemaJson = new \SchemaGenerate\StructureGenerate\Schemes\SchemaJson();
$schemaJson->setData($template);

$generator = new \SchemaGenerate\StructureGenerate\Generators\GeneratorService($parserStructureJson, $outputFileJson);
$result = $generator->process($schemaJson);
```

## Информация

В основе генерации случайных данных лежит пакет ``fakerphp/faker``

## Запуск тестов

`composer test`


## License

 [MIT license](https://github.com/NikitaSergeev/structure-generate/blob/main/LICENSE.md).