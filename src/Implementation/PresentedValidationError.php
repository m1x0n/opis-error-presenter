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
    private $keyword;

    /**
     * @var array
     */
    private $pointer;

    /**
     * @var string
     */
    private $message;

    public function __construct(
        string $keyword,
        array $pointer,
        string $message
    ) {
        $this->keyword = $keyword;
        $this->pointer = $pointer;
        $this->message = $message;
    }

    public function keyword(): string
    {
        return $this->keyword;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function pointer(): array
    {
        return $this->pointer;
    }

    public function pointerPath(string $delimiter = Contracts\PresentedValidationError::POINTER_DELIMITER): string
    {
        return implode($delimiter, $this->pointer);
    }

    public function toArray(): array
    {
        return [
            'keyword' => $this->keyword,
            'pointer' => $this->pointerPath(),
            'message' => $this->message,
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
