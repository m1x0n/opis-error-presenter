<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class PatternFormatter implements MessageFormatter
{
    private const MESSAGE = 'The attribute format is invalid.';

    public function format(ValidationError $error): string
    {
        return self::MESSAGE;
    }
}
