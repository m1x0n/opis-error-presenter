<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class Constant extends Formatter
{
    public const MESSAGE = "The attribute value expected to be ':expected:'.";

    public function replacements(): array
    {
        return [
            ':expected:' => $this->error->keywordArgs()['expected']
        ];
    }
}
