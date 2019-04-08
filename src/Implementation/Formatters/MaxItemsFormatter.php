<?php


declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class MaxItemsFormatter implements MessageFormatter
{
    private const MESSAGE = 'The attribute may not have more than :max items but :count: given.';

    public function format(ValidationError $error): string
    {
        $keywordArgs = $error->keywordArgs();

        $replacements = [
            ':max:' => $keywordArgs['max'],
            ':count:' => $keywordArgs['count'],
        ];

        return strtr(self::MESSAGE, $replacements);
    }
}
