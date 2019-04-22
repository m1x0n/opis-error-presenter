<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class OneOf implements MessageFormatter
{
    private const MESSAGE = 'The attribute must match exactly one of the subschemas.';

    public function format(ValidationError $error): string
    {
        return self::MESSAGE;
    }
}
