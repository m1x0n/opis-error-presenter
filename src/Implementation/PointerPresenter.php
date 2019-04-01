<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation;

class PointerPresenter
{
    public const DEFAULT_DELIMITER = '/';

    public function present(array $pointer, string $delimiter = self::DEFAULT_DELIMITER): string
    {
        return implode($delimiter, $pointer);
    }
}
