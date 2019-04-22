<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class Required implements MessageFormatter
{
    private const MESSAGE = "The attribute property ':missing:' is required.";

    public function format(ValidationError $error): string
    {
        $missing = $error->keywordArgs()['missing'];

        $replacements = [':missing:' => $missing];

        return strtr(self::MESSAGE, $replacements);
    }
}
