<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class PropertyNames extends Formatter
{
    public const MESSAGE = "The attribute property ':property:' has invalid format.";

    public function replacements(): array
    {
        return [
            ':property:' => $this->error->keywordArgs()['property']
        ];
    }
}
