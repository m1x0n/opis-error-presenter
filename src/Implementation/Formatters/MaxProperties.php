<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class MaxProperties extends Formatter
{
    public const MESSAGE = 'The attribute may not have more than :max properties but :count: given.';

    public function replacements(): array
    {
        $keywordArgs = $this->error->keywordArgs();

        return [
            ':max:' => $keywordArgs['max'],
            ':count:' => $keywordArgs['count'],
        ];
    }
}
