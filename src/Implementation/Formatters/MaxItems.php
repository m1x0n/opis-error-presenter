<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class MaxItems extends Formatter
{
    public const MESSAGE = 'The attribute may not have more than :max items but :count: given.';

    public function replacements(): array
    {
        $keywordArgs = $this->error->keywordArgs();

        return [
            ':max:' => $keywordArgs['max'],
            ':count:' => $keywordArgs['count'],
        ];
    }
}
