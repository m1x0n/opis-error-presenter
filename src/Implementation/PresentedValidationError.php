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
     * @var string
     */
    private $pointer;

    /**
     * @var string
     */
    private $message;

    public function __construct(string $keyword, string $pointer, string $message)
    {
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

    public function pointer(): string
    {
        return $this->pointer;
    }

    public function toArray(): array
    {
        return [
            'keyword' => $this->keyword,
            'pointer' => $this->pointer,
            'message' => $this->message,
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
