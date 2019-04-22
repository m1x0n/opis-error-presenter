<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class PropertyNames implements MessageFormatter
{
    private const MESSAGE = "The attribute property ':property:' has invalid format.";

    public function format(ValidationError $error): string
    {
        $expected = $error->keywordArgs()['property'];

        $replacements = [
            ':property:' => $expected
        ];

        return strtr(self::MESSAGE, $replacements);
    }
}
