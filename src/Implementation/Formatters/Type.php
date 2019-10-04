<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class Type extends Formatter
{
    public const MESSAGE = "The attribute expected to be of type ':expected:' but ':used:' given.";

    public function replacements(): array
    {
        $keywordArgs = $this->error->keywordArgs();
        $expected = (array)$keywordArgs['expected'];

        return [
            ':expected:' => implode(', ', array_map(
                function ($item) {
                        return "'{$item}'";
                },
                $expected
            )),
            ':used:' => $keywordArgs['used'],
        ];
    }
}
