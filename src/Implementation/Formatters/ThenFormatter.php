<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class ThenFormatter implements MessageFormatter
{
    private const MESSAGE = "The attribute does not match schema for 'then'.";

    public function format(ValidationError $error): string
    {
        return self::MESSAGE;
    }
}
