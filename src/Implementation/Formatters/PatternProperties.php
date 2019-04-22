<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class PatternProperties implements MessageFormatter
{
    private const MESSAGE = 'The attribute has invalid format.';

    public function format(ValidationError $error): string
    {
        return self::MESSAGE;
    }
}
