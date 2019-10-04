<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class ExclusiveMinimum extends Formatter
{
    public const MESSAGE = 'The attribute value must be greater than :min:.';

    public function replacements(): array
    {
        return [
            ':min:' => $this->error->keywordArgs()['min']
        ];
    }
}
