<?php
declare(strict_types=1);

namespace OpisErrorPresenter\Contracts;

interface PresentStrategy
{
    public function execute(PresentedValidationError ...$errors): array;
}
