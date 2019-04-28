<?php

namespace OpisErrorPresenterTests;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\PresentedValidationError;
use OpisErrorPresenter\Implementation\MessageFormatterFactory;
use OpisErrorPresenter\Implementation\PresentedValidationErrorFactory;
use OpisErrorPresenter\Implementation\ValidationErrorPresenter;
use PHPUnit\Framework\TestCase;

class ValidationErrorPresenterTest extends TestCase
{
    public function testShouldPresentValidationErrors(): void
    {
        $presenter = new ValidationErrorPresenter(
            new PresentedValidationErrorFactory(
                new MessageFormatterFactory
            )
        );

        $error = $this->createMock(ValidationError::class);
        $error->method('keyword')->willReturn('test');

        $presented = $presenter->present($error);

        $this->assertCount(1, $presented);
        $this->assertInstanceOf(PresentedValidationError::class, $presented[0]);
    }
}
