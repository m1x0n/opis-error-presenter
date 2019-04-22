<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class ElseKeyword implements MessageFormatter
{
    private const MESSAGE = "The attribute does not match schema for 'else'.";

    public function format(ValidationError $error): string
    {
        return self::MESSAGE;
    }
}
