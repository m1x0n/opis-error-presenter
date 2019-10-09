<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\LocaleResolvers;

use OpisErrorPresenter\Contracts\LocaleResolver;

class FixedLocaleResolver implements LocaleResolver
{
    private $locale;

    public function __construct(string $locale)
    {
        $this->locale = $locale;
    }

    public function resolve(): ?string
    {
        return $this->locale;
    }
}
