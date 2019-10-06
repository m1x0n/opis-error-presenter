<?php
declare(strict_types=1);

namespace Acme;

use OpisErrorPresenter\Contracts\Keyword;
use OpisErrorPresenter\Implementation\MessageFormatterFactory;
use OpisErrorPresenter\Implementation\PresentedValidationErrorFactory;
use OpisErrorPresenter\Implementation\Translators\DefaultTranslator;
use OpisErrorPresenter\Implementation\ValidationErrorPresenter;

class InternationalTranslator extends DefaultTranslator
{
    private const DEFAULT_LOCALE = 'en_US';

    private $messages = [];

    private const DEFAULT_MESSAGE = 'The attribute is invalid';

    public function __construct()
    {
        $this->loadMessages();
    }

    public function translate(string $key, array $replacements = [], $locale = null): string
    {
        if ($locale && array_key_exists($locale, $this->messages)) {
            $message = $this->messages[$locale][$key] ?? self::DEFAULT_MESSAGE;
            return strtr($message, $replacements);
        }

        // Fallback on default locale
        return parent::translate($key, $replacements, $locale);
    }

    private function loadMessages(): void
    {
        /*
            Locales structure example:
            [
               'locale_1' => [
                  'keyword' => 'translation_1'
                  ...
               ],
               'locale_2' => [
                  'keyword' => 'translation_2'
                  ...
               ],
               ...
            ]
        */
        $this->messages = [
            'de_DE' => [
                // The rest of other keywords ...
                Keyword::MIN_LENGTH => 'Die Attributlänge sollte mindestens betragen: min: Zeichen.'
                // ...
            ],
            'ru_RU' => [
                // ...
                Keyword::ENUM => 'Длина атрибута должна быть минимум :min: символов.'
                // ....
            ]
        ];
    }
}

// Then configure presenter factory
$presenter = new ValidationErrorPresenter(
    new PresentedValidationErrorFactory(
        new MessageFormatterFactory(),
        new InternationalTranslator()
    )
);
