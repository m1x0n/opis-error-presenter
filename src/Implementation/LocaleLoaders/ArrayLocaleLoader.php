<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\LocaleLoaders;

use OpisErrorPresenter\Contracts\LocaleLoader;
use RuntimeException;

class ArrayLocaleLoader implements LocaleLoader
{
    private const DEFAULT_LOCALE = 'en';

    private const DEFAULT_LOCALES_PATH = __DIR__ . '/../../../lang';

    private $paths = [
        self::DEFAULT_LOCALE => [self::DEFAULT_LOCALES_PATH]
    ];

    /**
     * @var array|null
     */
    private $locales;

    public function load(): array
    {
        if ($this->locales) {
            return $this->locales;
        }

        foreach ($this->paths as $locale => $paths) {
            $locales = [];
            foreach ($paths as $path) {
                $localePath = "{$path}/{$locale}.php";
                $locales[] = $this->loadFromPath($localePath);
            }

            $this->locales[$locale] = array_merge(...$locales);
        }

        return $this->locales;
    }

    private function loadFromPath(string $path): array
    {
        if (!file_exists($path)) {
            throw new RuntimeException(
                sprintf('File [%s] was not found.', $path)
            );
        }

        return include $path;
    }

    public function addPath(
        string $locale,
        string $path,
        bool $override = false
    ): self {
        if ($override) {
            $this->paths[$locale] = [$path];
            return $this;
        }

        if (array_key_exists($locale, $this->paths)) {
            $this->paths[$locale][] = $path;
        } else {
            $this->paths[$locale] = [$path];
        }

        return $this;
    }
}
