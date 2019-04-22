<?php
declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class Enum implements MessageFormatter
{
    private const MESSAGE = 'The attribute must be one of the following values: :expected:.';

    public function format(ValidationError $error): string
    {
        $expected = $error->keywordArgs()['expected'];

        $replacements = [
            ':expected:' => "'" . implode ("', '", $expected) . "'",
        ];

        return strtr(self::MESSAGE, $replacements);
    }
}
