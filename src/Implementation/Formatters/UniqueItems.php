<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class UniqueItems extends Formatter
{
    public const MESSAGE = "The attribute contains duplicated item: ':duplicate:'.";

    public function replacements(): array
    {
        return [
            ':duplicate:' => $this->error->keywordArgs()['duplicate']
        ];
    }
}
