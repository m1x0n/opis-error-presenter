<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\MessageFormatter;

abstract class Formatter implements MessageFormatter
{
    /**
     * @var ValidationError
     */
    protected $error;

    public function __construct(ValidationError $error)
    {
        $this->error = $error;
    }

    public function keyword(): string
    {
        return $this->error->keyword();
    }

    public function replacements(): array
    {
        return [];
    }
}
