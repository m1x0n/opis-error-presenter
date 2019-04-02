<?php

use Opis\JsonSchema\Schema;
use Opis\JsonSchema\ValidationResult;
use Opis\JsonSchema\Validator;
use OpisErrorPresenter\Implementation\MessageFormatterFactory;
use OpisErrorPresenter\Implementation\PointerPresenter;
use OpisErrorPresenter\Implementation\PresentedValidationErrorFactory;
use OpisErrorPresenter\Implementation\ValidationErrorPresenter;

require __DIR__ . '/../vendor/autoload.php';

$jsonSchema ='{
    "$schema": "http://json-schema.org/draft-07/schema#",
    "$id": "http://api.example.com/profile.json#",
    "type": "object",
    "properties": {
        "name": {
            "type": "string",
            "minLength": 1,
            "maxLength": 64,
            "pattern": "^[a-zA-Z0-9\\\-]+(\\\s[a-zA-Z0-9\\\-]+)*$"
        },
        "age": {
            "type": "integer",
            "minimum": 18,
            "maximum": 100
        },
        "test": {
            "const": "test"
        },
        "email": {
            "type": "string",
            "maxLength": 128,
            "format": "email"
        },
        "website": {
            "type": ["string", "null"],
            "maxLength": 128,
            "format": "hostname"
        },
        "location": {
            "type": "object",
            "properties": {
                 "country": {
                     "enum": ["US", "CA", "GB"]
                 },
                 "address": {
                     "type": "string",
                     "maxLength": 128
                 }
            },
            "required": ["country", "address"],
            "additionalProperties": false
        },
        "available_for_hire": {
            "type": "boolean"
        },
        "interests": {
            "type": "array",
            "minItems": 3,
            "maxItems": 100,
            "uniqueItems": true,
            "items": {
                "type": "string",
                "maxLength": 120
            }
        },
        "skills": {
            "type": "array",
            "maxItems": 100,
            "uniqueItems": true,
            "items": {
                "type": "object",
                "properties": {
                    "name": {
                        "type": "string",
                        "minLenght": 1,
                        "maxLength": 64
                    },
                    "value": {
                        "type": "number",
                        "minimum": 0,
                        "maximum": 100,
                        "multipleOf": 0.25
                    }
                },
                "required": ["name", "value"],
                "additionalProperties": false
            }
        }
    },
    "required": ["name", "age", "email", "location", 
                 "available_for_hire", "interests", "skills"],
    "additionalProperties": false
}';

$data = '{
    "name": "J",
    "age": "zzz",
    "test": "lol",
    "email": "johnbb",
    "website": null,
    "location": {
        "country": "UA",
        "address": "Sesame Street, no. 5"
    },
    "available_for_hire": true,
    "interests": ["php", "html", "css", "javascript", "programming", "web design"],
    "skills": [
        {
            "name": "HTML",
            "value": 100
        },
        {
            "name": "PHP",
            "value": 55
        },
        {
            "name": "CSS",
            "value": 99.5
        },
        {
            "name": "JavaScript",
            "value": 75
        }
    ]
}';

$data = json_decode($data);
$jsonSchema = Schema::fromJsonString($jsonSchema);
$validator = new Validator();

/** @var ValidationResult $result */
$result = $validator->schemaValidation($data, $jsonSchema, -1);

$presenter = new ValidationErrorPresenter(
    new PresentedValidationErrorFactory(
        new MessageFormatterFactory(),
        new PointerPresenter()
    )
);

$presented = $presenter->present(...$result->getErrors());

print_r($presented);
