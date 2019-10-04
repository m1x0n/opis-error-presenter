<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class MultipleOf extends Formatter
{
    public const MESSAGE = 'The attribute value should be multiple of :divisor:.';

    public function replacements(): array
    {
        return [
            ':divisor:' => $this->error->keywordArgs()['divisor']
        ];
    }
}
