<?php
declare(strict_types = 1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class DefaultFormatter implements MessageFormatter
{
    private const MESSAGE = 'Attribute is invalid.';

    public function format(ValidationError $error): string
    {
        return self::MESSAGE;
    }
}
