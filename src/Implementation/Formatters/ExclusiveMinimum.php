<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class ExclusiveMinimum implements MessageFormatter
{
    private const MESSAGE = 'The attribute value must be greater than :min:.';

    public function format(ValidationError $error): string
    {
        $min = $error->keywordArgs()['min'];

        $replacements = [':min:' => $min];

        return strtr(self::MESSAGE, $replacements);
    }
}
