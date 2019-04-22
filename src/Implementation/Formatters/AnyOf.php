<?php


declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class AnyOf implements MessageFormatter
{
    public function format(ValidationError $error): string
    {

    }
}
