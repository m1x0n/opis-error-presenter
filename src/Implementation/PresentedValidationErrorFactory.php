<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts;

class PresentedValidationErrorFactory
{
    private $messageFormatterFactory;
    private $pointerPresenter;

    public function __construct(
        MessageFormatterFactory $messageFormatterFactory,
        PointerPresenter $pointerPresenter
    ) {
        $this->messageFormatterFactory = $messageFormatterFactory;
        $this->pointerPresenter = $pointerPresenter;
    }

    public function create(ValidationError $error): Contracts\PresentedValidationError
    {
        $message = $this->messageFormatterFactory
            ->create($error)
            ->format($error);

        $pointer = $this->pointerPresenter->present($error->dataPointer());

        $keyword = $error->keyword();

        return new PresentedValidationError($keyword, $pointer, $message);
    }
}
