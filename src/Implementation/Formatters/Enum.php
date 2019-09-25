<?php
declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class Enum extends Formatter
{
    public const MESSAGE = 'The attribute must be one of the following values: :expected:.';

    public function replacements(): array
    {
        $keywordArgs = $this->error->keywordArgs();
        $expected = (array)$keywordArgs['expected'];

        return [
            ':expected:' => implode(', ', array_map(
                    function ($item) {
                        return "'{$item}'";
                    }, $expected)
            ),
        ];
    }
}
