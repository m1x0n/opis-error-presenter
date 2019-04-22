opis-json-schema-error-presenter
=====

Customizable error presenter for json schema validation errors produced
by [opis/json-schema](https://github.com/opis/json-schema) library: [JSON schema](http://json-schema.org/) implementation.

In other words it's a raw attempt to represent `Opis\JsonSchema\ValidationError` collection in
human readable way.

### Requirements
- php >= 7.1

### Installation

```bash
composer require m1x0n/opis-json-schema-error-presenter
```

### Usage example
```php7
TBD
```

### Output result example
```
TBD
```

### Presenting Strategies
- `AllErrors` - shows all available presented errors
- `FirstError` - picks the first of the presented errors
- `BestMatchError` - evaluates best matching error

### TODO
- Unit tests coverage
- TravisCI
- Packagist publish
