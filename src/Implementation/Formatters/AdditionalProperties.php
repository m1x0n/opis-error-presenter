<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class AdditionalProperties implements MessageFormatter
{
    private const MESSAGE = 'The attribute must not contain additional properties.';

    public function format(ValidationError $error): string
    {
        return self::MESSAGE;
    }
}
