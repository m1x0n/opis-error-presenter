<?php
declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class MaximumFormatter implements MessageFormatter
{
    private const MESSAGE = 'The attribute value must be less than or equal :max:.';

    public function format(ValidationError $error): string
    {
        $max = $error->keywordArgs()['max'];

        $replacements = [':max:' => $max];

        return strtr(self::MESSAGE, $replacements);
    }
}
