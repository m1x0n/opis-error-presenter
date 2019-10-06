<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\LocaleResolvers;

use OpisErrorPresenter\Contracts\LocaleResolver;

class NullLocaleResolver implements LocaleResolver
{
    public function resolve(): ?string
    {
        return null;
    }
}
