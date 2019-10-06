opis-json-schema-error-presenter [![Build Status](https://travis-ci.org/m1x0n/opis-error-presenter.svg?branch=master)](https://travis-ci.org/m1x0n/opis-error-presenter)
=====

Customizable error presenter for json schema validation errors produced
by [opis/json-schema](https://github.com/opis/json-schema) library: [JSON schema](http://json-schema.org/) implementation.

In other words it's a raw attempt to represent `Opis\JsonSchema\ValidationError` collection in
human readable way.

### Requirements
- php >= 7.1
- opis/json-schema

### Installation

```bash
composer require m1x0n/opis-json-schema-error-presenter
```

### Usage example
```php
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
```

### Output result example
```
Array
(
    [0] => Array
        (
            [keyword] => type
            [pointer] => productId
            [message] => The attribute expected to be of type 'integer' but 'string' given.
        )

    [1] => Array
        (
            [keyword] => minLength
            [pointer] => productName
            [message] => The attribute length should be at least 3 characters.
        )

    [2] => Array
        (
            [keyword] => enum
            [pointer] => price/currency
            [message] => The attribute must be one of the following values: 'USD', 'EUR', 'BTC'.
        )

)
```

### Presenting Strategies
- `AllErrors` - shows all available presented errors
- `FirstError` - picks the first of the presented errors
- `BestMatchError` - evaluates best matching error

In order to specify strategy simply pass selected one to
`PresentedValidationErrorFactory`, e.g:

```php
$presenter = new ValidationErrorPresenter(
    new PresentedValidationErrorFactory(
        new MessageFormatterFactory(
            new BestMatchError()
        )
    )
);
```

### Custom translations
There is a possibility to have custom translations.
Currently there is only `DefaultTranslator` which exposes some generic messages like:

`The attribute length should be at least 3 characters`

In order to replace or extend or come up with new translations `MessageTranslator` interface
must be implemented.
For example:

```php
<?php
declare(strict_types=1);

namespace Acme;

use OpisErrorPresenter\Contracts\Keyword;
use OpisErrorPresenter\Implementation\MessageFormatterFactory;
use OpisErrorPresenter\Implementation\PresentedValidationErrorFactory;
use OpisErrorPresenter\Implementation\Translators\DefaultTranslator;
use OpisErrorPresenter\Implementation\ValidationErrorPresenter;

class InternationalTranslator extends DefaultTranslator
{
    private const DEFAULT_LOCALE = 'en_US';

    private $messages = [];

    private const DEFAULT_MESSAGE = 'The attribute is invalid';

    public function __construct()
    {
        $this->loadMessages();
    }

    public function translate(string $key, array $replacements = [], $locale = null): string
    {
        if ($locale && array_key_exists($locale, $this->messages)) {
            $message = $this->messages[$locale][$key] ?? self::DEFAULT_MESSAGE;
            return strtr($message, $replacements);
        }

        // Fallback on default locale
        return parent::translate($key, $replacements, $locale);
    }

    private function loadMessages(): void
    {
        /*
            Locales structure example:
            [
               'locale_1' => [
                  'keyword' => 'translation_1'
                  ...
               ],
               'locale_2' => [
                  'keyword' => 'translation_2'
                  ...
               ],
               ...
            ]
        */
        $this->messages = [
            'de_DE' => [
                // The rest of other keywords ...
                Keyword::MIN_LENGTH => 'Die Attributlänge sollte mindestens betragen: min: Zeichen.'
                // ...
            ],
            'ru_RU' => [
                // ...
                Keyword::ENUM => 'Длина атрибута должна быть минимум :min: символов.'
                // ....
            ]
        ];
    }
}
```
Then configure presenter:
```php
$presenter = new ValidationErrorPresenter(
    new PresentedValidationErrorFactory(
        new MessageFormatterFactory(),
        new InternationalTranslator()
    )
);
```

### Locale resolving
For better experience with different localizations custom translator could be used
alongside with automatic locale resolution.

Currently next locale resolvers are implemented:
- `NullLocaleResolver` as fallback to generic messages.
- `HttpLocaleResolver` tries to detect locale based on `HTTP_ACCEPT_LANGUAGE` header and requires `ext-intl` to be installed.

It's also possible to implement custom locale resolver by implementing `LocaleResolver` interface.

To set up `HttpLocaleResolver` or custom-crafted one:
```php
$presenter = new ValidationErrorPresenter(
    new PresentedValidationErrorFactory(
        new MessageFormatterFactory(),
        new InternationalTranslator(),
        new HttpLocaleResolver()
    )
);
```
