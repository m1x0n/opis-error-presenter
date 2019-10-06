<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\LocaleResolvers;

use Locale;
use OpisErrorPresenter\Contracts\LocaleResolver;
use RuntimeException;

class HttpLocaleResolver implements LocaleResolver
{
    public function resolve(): ?string
    {
        if (! extension_loaded('intl')) {
            throw new RuntimeException('Extension ext-intl is not loaded');
        }

        return Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
    }
}
