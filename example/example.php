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
            "exclusiveMaximum": 100
        },
        "test": {
            "const": "test"
        },
        "email": {
            "allOf": [
                { "type": "string" },
                { "maxLength": 128 },
                { "minLength": 3 },
                { "format": "email" }
            ]
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
            "additionalProperties": true,
            "propertyNames": {
                "pattern": "^[a-z]*$"
            },
            "patternProperties": {
                "^M_": { "type": "integer" }
            }
        },
        "available_for_hire": {
            "not": { "type": "string" }
        },
        "interests": {
            "type": "array",
            "minItems": 50,
            "maxItems": 100,
            "uniqueItems": true,
            "contains": {
                "type": "integer"
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
                    },
                    "years": {
                        "type": "integer"
                    },
                    "test": {
                        "type": "boolean"
                    }
                },
                "required": ["name"],
                "additionalProperties": true,
                "dependencies": {
                    "years": ["value", "test"]
                }
            }
        }
    },
    "required": ["name", "age", "email", "location",
                 "available_for_hire", "interests", "skills", "lol"],
    "additionalProperties": false,
    "minProperties": 10
}';

$data = '{
    "name": "J***",
    "age": 101,
    "test": "lol",
    "email": "aa",
    "website": null,
    "location": {
        "country": "UA",
        "address": "Sesame Street, no. 5",
        "Province": "Country Yard",
        "M_0": "29"
    },
    "available_for_hire": "true",
    "interests": ["php", "php", "html", "css", "javascript", "programming", "web design"],
    "skills": [
        {
            "name": "HTML",
            "value": 100
        },
        {
            "name": "PHP",
            "years": 100
        },
        {
            "name": "CSS",
            "value": 99.5
        },
        {
            "name": "JavaScript",
            "value": 75.3
        }
    ]
}';

$data = json_decode($data);
$jsonSchema = Schema::fromJsonString($jsonSchema);
$validator = new Validator();

// Get all errors. Yeah -1 here.
/** @var ValidationResult $result */
$result = $validator->schemaValidation($data, $jsonSchema, -1);

// Default strategy is all error
$presenter = new ValidationErrorPresenter(
    new PresentedValidationErrorFactory(
        new MessageFormatterFactory(),
        new PointerPresenter()
    )
    //new \OpisErrorPresenter\Implementation\Strategies\FirstError()
);

$presented = $presenter->present(...$result->getErrors());

// Inspected presenter error
print_r($presented);

// Json-serializable
echo json_encode($presented);
