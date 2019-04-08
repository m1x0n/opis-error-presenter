<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

class UniqueItemsFormatter implements MessageFormatter
{
    private const MESSAGE = "The attribute contains duplicated item: ':duplicate:'.";

    public function format(ValidationError $error): string
    {
        $duplicate = $error->keywordArgs()['duplicate'];

        $replacements = [':duplicate:' => $duplicate];

        return strtr(self::MESSAGE, $replacements);
    }
}
