<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class MultipleOf implements MessageFormatter
{
    private const MESSAGE = 'The attribute value should be multiple of :divisor:.';

    public function format(ValidationError $error): string
    {
        $divisor = $error->keywordArgs()['divisor'];

        $replacements = [':divisor:' => $divisor];

        return strtr(self::MESSAGE, $replacements);
    }
}
