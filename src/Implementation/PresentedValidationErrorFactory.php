<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts;
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

    public function __construct(
        MessageFormatterFactory $messageFormatterFactory,
        ?Contracts\MessageTranslator $messageTranslator = null
    ) {
        $this->messageFormatterFactory = $messageFormatterFactory;
        $this->messageTranslator = $messageTranslator ?: new DefaultTranslator();
    }

    public function create(ValidationError $error): Contracts\PresentedValidationError
    {
        $formatter = $this->messageFormatterFactory->create($error);

        $keyword = $error->keyword();
        $pointer = $error->dataPointer();

        $message = $this->messageTranslator->translate(
            $formatter->keyword(),
            $formatter->replacements()
        );

        return new PresentedValidationError($keyword, $pointer, $message);
    }
}
