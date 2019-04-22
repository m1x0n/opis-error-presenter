<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class MaxLength implements MessageFormatter
{
    private const MESSAGE = 'The attribute length may not be greater than :max: characters.';

    public function format(ValidationError $error): string
    {
        $max = $error->keywordArgs()['max'];

        $replacements = [':max:' => $max];

        return strtr(self::MESSAGE, $replacements);
    }
}
