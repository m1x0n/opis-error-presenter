<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class MinLength extends Formatter
{
    public const MESSAGE = 'The attribute length should be at least :min: characters.';

    public function replacements(): array
    {
        return [
            ':min:' => $this->error->keywordArgs()['min']
        ];
    }
}
