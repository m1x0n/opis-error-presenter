<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Contracts;

interface LocaleResolver
{
    public function resolve(): ?string;
}
