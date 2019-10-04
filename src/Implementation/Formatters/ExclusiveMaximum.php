<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class ExclusiveMaximum extends Formatter
{
    public const MESSAGE = 'The attribute value must be less than :max:.';

    public function replacements(): array
    {
        return [
            ':max:' => $this->error->keywordArgs()['max']
        ];
    }
}
