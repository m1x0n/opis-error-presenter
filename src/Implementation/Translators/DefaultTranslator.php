<?php
declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Translators;

use OpisErrorPresenter\Contracts\Keyword;
use OpisErrorPresenter\Contracts\MessageTranslator;
use OpisErrorPresenter\Implementation\Formatters;

class DefaultTranslator implements MessageTranslator
{
    private const MESSAGES = [
        Keyword::TYPE => Formatters\Type::MESSAGE,
        Keyword::ENUM => Formatters\Enum::MESSAGE,
        Keyword::CONST => Formatters\Constant::MESSAGE,
        Keyword::FORMAT => Formatters\Format::MESSAGE,
        Keyword::MULTIPLE_OF => Formatters\MultipleOf::MESSAGE,
        Keyword::MAXIMUM => Formatters\Maximum::MESSAGE,
        Keyword::EXCLUSIVE_MAXIMUM => Formatters\ExclusiveMaximum::MESSAGE,
        Keyword::MINIMUM => Formatters\Minimum::MESSAGE,
        Keyword::EXCLUSIVE_MINIMUM => Formatters\ExclusiveMinimum::MESSAGE,
        Keyword::MAX_LENGTH => Formatters\MaxLength::MESSAGE,
        Keyword::MIN_LENGTH => Formatters\MinLength::MESSAGE,
        Keyword::PATTERN => Formatters\Pattern::MESSAGE,
        Keyword::ITEMS => Formatters\Items::MESSAGE,
        Keyword::ADDITIONAL_ITEMS => Formatters\AdditionalItems::MESSAGE,
        Keyword::MIN_ITEMS => Formatters\MinItems::MESSAGE,
        Keyword::MAX_ITEMS => Formatters\MaxItems::MESSAGE,
        Keyword::UNIQUE_ITEMS => Formatters\UniqueItems::MESSAGE,
        Keyword::CONTAINS => Formatters\Contains::MESSAGE,
        Keyword::MIN_PROPERTIES => Formatters\MinProperties::MESSAGE,
        Keyword::MAX_PROPERTIES => Formatters\MaxProperties::MESSAGE,
        Keyword::REQUIRED => Formatters\Required::MESSAGE,
        Keyword::PATTERN_PROPERTIES => Formatters\PatternProperties::MESSAGE,
        Keyword::DEPENDENCIES => Formatters\Dependencies::MESSAGE,
        Keyword::PROPERTY_NAMES => Formatters\PropertyNames::MESSAGE,
        Keyword::ADDITIONAL_PROPERTIES => Formatters\AdditionalProperties::MESSAGE,
        Keyword::THEN => Formatters\ThenFormatter::MESSAGE,
        Keyword::ELSE => Formatters\ElseKeyword::MESSAGE,
        Keyword::ALL_OF => Formatters\AllOf::MESSAGE,
        Keyword::ANY_OF => Formatters\AnyOf::MESSAGE,
        Keyword::ONE_OF => Formatters\OneOf::MESSAGE,
        Keyword::NOT => Formatters\NotKeyword::MESSAGE,
    ];

    private const DEFAULT_MESSAGE = 'The attribute is invalid';

    public function translate(string $key, array $replacements = [], $locale = null): string
    {
        $message = self::MESSAGES[$key] ?? self::DEFAULT_MESSAGE;

        return strtr($message, $replacements);
    }
}
