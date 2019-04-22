<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class MinProperties implements MessageFormatter
{
    private const MESSAGE = 'The attribute must have at least :min: properties but :count: given.';

    public function format(ValidationError $error): string
    {
        $keywordArgs = $error->keywordArgs();

        $replacements = [
            ':min:' => $keywordArgs['min'],
            ':count:' => $keywordArgs['count'],
        ];

        return strtr(self::MESSAGE, $replacements);
    }
}
