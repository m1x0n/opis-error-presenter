<?php

declare(strict_types = 1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class ConstFormatter implements MessageFormatter
{
    private const MESSAGE = "Attribute value expected to be ':expected:'.";

    public function format(ValidationError $error): string
    {
        $expected = $error->keywordArgs()['expected'];

        $replacements = [
            ':expected:' => $expected
        ];

        return strtr(self::MESSAGE, $replacements);
    }
}
