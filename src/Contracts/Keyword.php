<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Contracts;

interface Keyword
{
    // Instance type
    public const TYPE = 'type';
    public const ENUM = 'enum';
    public const CONST = 'const';

    // Numeric Instances
    public const MULTIPLY_OF = 'multiplyOf';
    public const MAXIMUM = 'maximum';
    public const EXCLUSIVE_MAXIMUM = 'exclusiveMaximum';
    public const MINIMUM = 'minimum';
    public const EXCLUSIVE_MINIMUM = 'exclusiveMinimum';

    // Strings
    public const MAX_LENGTH = 'maxLength';
    public const MIN_LENGTH = 'minLength';
    public const PATTERN = 'pattern';

    // Arrays
    public const ITEMS = 'items';
    public const ADDITIONAL_ITEMS = 'additionalItems';
    public const MAX_ITEMS = 'maxItems';
    public const MIN_ITEMS = 'minItems';
    public const UNIQUE_ITEMS = 'uniqueItems';
    public const CONTAINS = 'contains';

    // Objects
    public const MAX_PROPERTIES = 'maxProperties';
    public const MIN_PROPERTIES = 'minProperties';
    public const REQUIRED = 'required';
    public const PROPERTIES = 'properties';
    public const PATTERN_PROPERTIES = 'patternProperties';
    public const DEPENDENCIES = 'dependencies';
    public const PROPERTY_NAMES = 'propertyNames';

    // Conditional subschemas
    public const IF = 'if';
    public const THEN = 'then';
    public const ELSE = 'else';

    // Subschemas with boolean logic
    public const ALL_OF = 'allOf';
    public const ANY_OF = 'anyOf';
    public const ONE_OF = 'oneOf';
    public const NOT = 'not';

    // Format validation
    public const FORMAT = 'format';
}
