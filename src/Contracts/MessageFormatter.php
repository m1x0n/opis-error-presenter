<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Contracts;

interface MessageFormatter
{
    public function keyword(): string;

    public function replacements(): array;
}
