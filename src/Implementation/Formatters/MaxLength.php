<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class MaxLength extends Formatter
{
    public const MESSAGE = 'The attribute length may not be greater than :max: characters.';

    public function replacements(): array
    {
        return [
            ':max:' => $this->error->keywordArgs()['max']
        ];
    }
}
