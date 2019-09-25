<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class MinItems extends Formatter
{
    public const MESSAGE = 'The attribute must have at least :min: items but :count: given.';

    public function replacements(): array
    {
        $keywordArgs = $this->error->keywordArgs();

        return [
            ':min:' => $keywordArgs['min'],
            ':count:' => $keywordArgs['count'],
        ];
    }
}
