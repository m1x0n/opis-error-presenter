<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Contracts;

interface PresentedValidationError
{
    public const POINTER_DELIMITER = '/';

    public function message(): string;
    public function pointer(): array;
    public function keyword(): string;
    public function pointerPath(string $delimiter = self::POINTER_DELIMITER): string;
    public function toArray(): array;
}
