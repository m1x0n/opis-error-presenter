<?php
declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class Maximum extends Formatter
{
    public const MESSAGE = 'The attribute value must be less than or equal :max:.';

    public function replacements(): array
    {
        return [
            ':max:' => $this->error->keywordArgs()['max']
        ];
    }
}
