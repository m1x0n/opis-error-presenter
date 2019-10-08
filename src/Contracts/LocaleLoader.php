<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Contracts;

interface LocaleLoader
{
    public const LOCALE_FALLBACK = 'en';

    public function load(): array;
}
