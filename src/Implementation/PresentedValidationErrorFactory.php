<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts;
use OpisErrorPresenter\Implementation\LocaleResolvers\NullLocaleResolver;
use OpisErrorPresenter\Implementation\Translators\DefaultTranslator;

class PresentedValidationErrorFactory
{
    /**
     * @var MessageFormatterFactory
     */
    private $messageFormatterFactory;

    /**
     * @var Contracts\MessageTranslator
     */
    private $messageTranslator;

    /**
     * @var Contracts\LocaleResolver
     */
    private $localeResolver;

    public function __construct(
        MessageFormatterFactory $messageFormatterFactory,
        ?Contracts\MessageTranslator $messageTranslator = null,
        ?Contracts\LocaleResolver $localeResolver = null
    ) {
        $this->messageFormatterFactory = $messageFormatterFactory;
        $this->messageTranslator = $messageTranslator ?: new DefaultTranslator();
        $this->localeResolver = $localeResolver ?: new NullLocaleResolver();
    }

    public function create(ValidationError $error): Contracts\PresentedValidationError
    {
        $formatter = $this->messageFormatterFactory->create($error);
        $locale = $this->localeResolver->resolve();

        $keyword = $error->keyword();
        $pointer = $error->dataPointer();

        $message = $this->messageTranslator->translate(
            $formatter->keyword(),
            $formatter->replacements(),
            $locale
        );

        return new PresentedValidationError($keyword, $pointer, $message);
    }
}
