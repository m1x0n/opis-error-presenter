<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class AllOf implements MessageFormatter
{
    private const MESSAGE = 'The attribute must be valid against all of the subschemas.';

    public function format(ValidationError $error): string
    {
        return self::MESSAGE;
    }
}
