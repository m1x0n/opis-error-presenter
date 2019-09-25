<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class MinProperties extends Formatter
{
    public const MESSAGE = 'The attribute must have at least :min: properties but :count: given.';

    public function replacements(): array
    {
        $keywordArgs = $this->error->keywordArgs();

        return [
            ':min:' => $keywordArgs['min'],
            ':count:' => $keywordArgs['count'],
        ];
    }
}
