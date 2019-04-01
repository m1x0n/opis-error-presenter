<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Contracts;

use Opis\JsonSchema\ValidationError;

interface ValidationErrorPresenter
{
    public function present(ValidationError ...$errors): array;
}
