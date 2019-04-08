<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class ContainsFormatter implements MessageFormatter
{
    private const MESSAGE = 'The attribute contains invalid items.';

    public function format(ValidationError $error): string
    {
        return self::MESSAGE;
    }
}
