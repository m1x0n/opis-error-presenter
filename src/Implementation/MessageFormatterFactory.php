<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\Keyword;
use OpisErrorPresenter\Contracts\MessageFormatter;
use OpisErrorPresenter\Implementation\Formatters;

class MessageFormatterFactory
{
    private const FORMATTERS = [
        Keyword::TYPE => Formatters\Type::class,
        Keyword::ENUM => Formatters\Enum::class,
        Keyword::CONST => Formatters\Constant::class,
        Keyword::FORMAT => Formatters\Format::class,
        Keyword::MULTIPLE_OF => Formatters\MultipleOf::class,
        Keyword::MAXIMUM => Formatters\Maximum::class,
        Keyword::EXCLUSIVE_MAXIMUM => Formatters\ExclusiveMaximum::class,
        Keyword::MINIMUM => Formatters\Minimum::class,
        Keyword::EXCLUSIVE_MINIMUM => Formatters\ExclusiveMinimum::class,
        Keyword::MAX_LENGTH => Formatters\MaxLength::class,
        Keyword::MIN_LENGTH => Formatters\MinLength::class,
        Keyword::PATTERN => Formatters\Pattern::class,
        Keyword::ITEMS => Formatters\Items::class,
        Keyword::ADDITIONAL_ITEMS => Formatters\AdditionalItems::class,
        Keyword::MIN_ITEMS => Formatters\MinItems::class,
        Keyword::MAX_ITEMS => Formatters\MaxItems::class,
        Keyword::UNIQUE_ITEMS => Formatters\UniqueItems::class,
        Keyword::CONTAINS => Formatters\Contains::class,
        Keyword::MIN_PROPERTIES => Formatters\MinProperties::class,
        Keyword::MAX_PROPERTIES => Formatters\MaxProperties::class,
        Keyword::REQUIRED => Formatters\Required::class,
        Keyword::PATTERN_PROPERTIES => Formatters\PatternProperties::class,
        Keyword::DEPENDENCIES => Formatters\Dependencies::class,
        Keyword::PROPERTY_NAMES => Formatters\PropertyNames::class,
        Keyword::ADDITIONAL_PROPERTIES => Formatters\AdditionalProperties::class,
        Keyword::THEN => Formatters\ThenFormatter::class,
        Keyword::ELSE => Formatters\ElseKeyword::class,
        Keyword::ALL_OF => Formatters\AllOf::class,
        Keyword::ANY_OF => Formatters\AnyOf::class,
        Keyword::ONE_OF => Formatters\OneOf::class,
        Keyword::NOT => Formatters\NotKeyword::class,
    ];

    private $customFormatters = [];

    public function create(ValidationError $error): MessageFormatter
    {
        // Temporary solution
        $formatter = self::FORMATTERS[$error->keyword()]
            ?? $this->customFormatters[$error->keyword()]
            ?? null;

        if ($formatter === null) {
            return new Formatters\InvalidAttribute($error);
        }

        return new $formatter($error);
    }

    /**
     * TODO: Probably move out of there
     * @param string $keyword
     * @param string $className
     */
    public function addFormatter(string $keyword, string $className): void
    {
        $this->customFormatters[$keyword] = $className;
    }
}
