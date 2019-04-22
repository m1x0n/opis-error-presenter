<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Strategies;

use OpisErrorPresenter\Contracts\PresentedValidationError;
use OpisErrorPresenter\Contracts\PresentStrategy;

class FirstError implements PresentStrategy
{
    public function execute(PresentedValidationError ...$errors): array
    {
        $first = reset($errors);

        return [$first];
    }
}
