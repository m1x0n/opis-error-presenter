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
        Keyword::TYPE => Formatters\TypeFormatter::class,
        Keyword::ENUM => Formatters\EnumFormatter::class,
        Keyword::CONST => Formatters\ConstFormatter::class,
        Keyword::FORMAT => Formatters\FormatFormatter::class,

        Keyword::MULTIPLE_OF => Formatters\MultipleOfFormatter::class,
        Keyword::MAXIMUM => Formatters\MaximumFormatter::class,
        Keyword::EXCLUSIVE_MAXIMUM => Formatters\ExclusiveMaximumFormatter::class,
        Keyword::MINIMUM => Formatters\MinimumFormatter::class,
        Keyword::EXCLUSIVE_MINIMUM => Formatters\ExclusiveMinimumFormatter::class,


    ];

    public function create(ValidationError $error): MessageFormatter
    {
        $formatter = self::FORMATTERS[$error->keyword()] ?? null;

        if ($formatter === null) {
            return new Formatters\DefaultFormatter;
        }

        return new $formatter;
    }
}
