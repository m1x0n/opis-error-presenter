<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Translators;

use OpisErrorPresenter\Contracts\LocaleLoader;
use OpisErrorPresenter\Contracts\MessageTranslator;
use OpisErrorPresenter\Implementation\LocaleLoaders\ArrayLocaleLoader;

class DefaultTranslator implements MessageTranslator
{
    private const DEFAULT_MESSAGE = 'The attribute is invalid';

    protected $messages = [];

    public function __construct(LocaleLoader $localeLoader = null)
    {
        $this->messages = ($localeLoader ?? new ArrayLocaleLoader())->load();
    }

    public function translate(string $key, array $replacements = [], $locale = null): string
    {
        $locale = $locale ?? LocaleLoader::LOCALE_FALLBACK;

        $message = $this->messages[$locale][$key] ?? self::DEFAULT_MESSAGE;

        return strtr($message, $replacements);
    }
}
