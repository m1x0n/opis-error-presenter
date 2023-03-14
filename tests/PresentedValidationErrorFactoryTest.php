<?php

namespace OpisErrorPresenterTests;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Implementation\MessageFormatterFactory;
use OpisErrorPresenter\Implementation\PresentedValidationErrorFactory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \OpisErrorPresenter\Implementation\PresentedValidationErrorFactory
 */
class PresentedValidationErrorFactoryTest extends TestCase
{
    private const EXPECTED_MESSAGE = 'The attribute is invalid';

    public function testShouldCreatePresentedValidationError(): void
    {
        $factory = new PresentedValidationErrorFactory(
            new MessageFormatterFactory()
        );

        $error = $this->createMock(ValidationError::class);
        $error->method('keyword')->willReturn('test');

        $presentedError = $factory->create($error);

        $this->assertStringContainsString(
            self::EXPECTED_MESSAGE,
            $presentedError->message()
        );
    }
}
