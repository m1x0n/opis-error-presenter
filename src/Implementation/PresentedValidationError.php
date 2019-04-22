<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation;

use OpisErrorPresenter\Contracts;

/**
 * Class PresentedError
 * @package OpisErrorPresenter\Implementation
 */
class PresentedValidationError implements Contracts\PresentedValidationError, \JsonSerializable
{
    /**
     * @var string
     */
    private $pointer;

    /**
     * @var string
     */
    private $message;

    public function __construct(string $pointer, string $message)
    {
        $this->pointer = $pointer;
        $this->message = $message;
    }

    public function message(): string
    {
        return $this->pointer;
    }

    public function pointer(): string
    {
        return $this->message;
    }

    public function toArray(): array
    {
        return [
            'pointer' => $this->pointer,
            'message' => $this->message,
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
