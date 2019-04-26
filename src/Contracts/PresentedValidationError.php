<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Contracts;

interface PresentedValidationError
{
    public function message(): string;
    public function pointer(): string;
    public function keyword(): string;
    public function toArray(): array;
}
