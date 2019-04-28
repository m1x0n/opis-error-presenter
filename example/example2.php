<?php

use Opis\JsonSchema\Schema;
use Opis\JsonSchema\ValidationResult;
use Opis\JsonSchema\Validator;
use OpisErrorPresenter\Contracts\PresentedValidationError;
use OpisErrorPresenter\Implementation\MessageFormatterFactory;
use OpisErrorPresenter\Implementation\PresentedValidationErrorFactory;
use OpisErrorPresenter\Implementation\ValidationErrorPresenter;

require __DIR__ . '/../vendor/autoload.php';

$jsonSchema ='{
  "$schema": "http://json-schema.org/draft-07/schema#",
  "$id": "http://example.com/product.schema.json",
  "title": "Product",
  "description": "A product from Acme\'s catalog",
  "type": "object",
  "properties": {
    "productId": {
      "type": "integer",
      "minimum": 1
    },
    "productName": {
      "type": "string",
      "minLength": 3
    },
    "price": {
      "type": "object",
      "properties": {
        "amount": {
          "type": "integer",
          "minimum": 0,
          "maximum": 1000
        },
        "currency": {
          "type": "string",
          "enum": ["USD", "EUR", "BTC"]
        }
      },
      "required": ["amount", "currency"]
    }
  },
  "required": [ "productId", "productName", "price" ]
}';

$data = '{
  "productId": "123",
  "productName": "XX",
  "price": {
    "amount": 200,
    "currency": "GBP"
  }
}';

$data = json_decode($data);
$jsonSchema = Schema::fromJsonString($jsonSchema);
$validator = new Validator();

// Get all errors. Yeah -1 here.
/** @var ValidationResult $result */
$result = $validator->schemaValidation($data, $jsonSchema, -1);

// Default strategy is AllErrors
$presenter = new ValidationErrorPresenter(
    new PresentedValidationErrorFactory(
        new MessageFormatterFactory()
    )
);

$presented = $presenter->present(...$result->getErrors());

// Inspected presenter error
print_r(array_map(static function (PresentedValidationError $error) {
    return $error->toArray();
}, $presented));

// Json-serializable
echo json_encode($presented);
