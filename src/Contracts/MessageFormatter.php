<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Contracts;

use Opis\JsonSchema\ValidationError;

interface MessageFormatter
{
    public function format(ValidationError $error): string;
}
