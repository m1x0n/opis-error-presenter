<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Contracts;

interface MessageTranslator
{
    public function translate(string $key, array $replacements = [], $locale = null): string;
}
