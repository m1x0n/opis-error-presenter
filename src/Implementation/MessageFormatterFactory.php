<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\Keyword;
use OpisErrorPresenter\Contracts\MessageFormatter;
use OpisErrorPresenter\Implementation\Formatters\ConstFormatter;
use OpisErrorPresenter\Implementation\Formatters\DefaultFormatter;
use OpisErrorPresenter\Implementation\Formatters\EnumFormatter;
use OpisErrorPresenter\Implementation\Formatters\FormatFormatter;
use OpisErrorPresenter\Implementation\Formatters\TypeFormatter;

class MessageFormatterFactory
{
    private const FORMATTERS = [
        Keyword::TYPE => TypeFormatter::class,
        Keyword::ENUM => EnumFormatter::class,
        Keyword::CONST => ConstFormatter::class,
        Keyword::FORMAT => FormatFormatter::class,
    ];

    public function create(ValidationError $error): MessageFormatter
    {
        $formatter = self::FORMATTERS[$error->keyword()] ?? null;

        if ($formatter === null) {
            return new DefaultFormatter;
        }

        return new $formatter;
    }
}
