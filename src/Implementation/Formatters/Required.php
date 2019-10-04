<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class Required extends Formatter
{
    public const MESSAGE = "The attribute property ':missing:' is required.";

    public function replacements(): array
    {
        return [
            ':missing:' => $this->error->keywordArgs()['missing']
        ];
    }
}
