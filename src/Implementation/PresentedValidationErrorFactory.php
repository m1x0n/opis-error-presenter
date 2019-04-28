<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts;

class PresentedValidationErrorFactory
{
    /**
     * @var MessageFormatterFactory
     */
    private $messageFormatterFactory;

    public function __construct(
        MessageFormatterFactory $messageFormatterFactory
    ) {
        $this->messageFormatterFactory = $messageFormatterFactory;
    }

    public function create(ValidationError $error): Contracts\PresentedValidationError
    {
        $message = $this->messageFormatterFactory
            ->create($error)
            ->format($error);

        $keyword = $error->keyword();
        $pointer = $error->dataPointer();

        return new PresentedValidationError($keyword, $pointer, $message);
    }
}
