<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class MinLengthFormatter implements MessageFormatter
{
    private const MESSAGE = 'The attribute length should be at least :min: characters.';

    public function format(ValidationError $error): string
    {
        $min = $error->keywordArgs()['min'];

        $replacements = [':min:' => $min];

        return strtr(self::MESSAGE, $replacements);
    }
}
