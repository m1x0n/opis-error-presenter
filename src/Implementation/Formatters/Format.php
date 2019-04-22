<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class Format implements MessageFormatter
{
    private const MESSAGE = "The attribute should match ':format:' format.";

    public function format(ValidationError $error): string
    {
        $format = $error->keywordArgs()['format'] ?? null;
        $replacements = $format ? [':format:' => $format] : [];

        return strtr(self::MESSAGE, $replacements);
    }
}
