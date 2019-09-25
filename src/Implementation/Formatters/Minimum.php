<?php
declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class Minimum extends Formatter
{
    public const MESSAGE = 'The attribute value must be greater than or equal :min:.';

    public function replacements(): array
    {
        return [
            ':min:' => $this->error->keywordArgs()['min']
        ];
    }
}
