<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class Format extends Formatter
{
    public const MESSAGE = "The attribute should match ':format:' format.";

    public function replacements(): array
    {
        $format = $this->error->keywordArgs()['format'] ?? null;

        return $format ? [':format:' => $format] : [];
    }
}
