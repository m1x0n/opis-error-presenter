<?php

namespace OpisErrorPresenterTests;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\Keyword;
use OpisErrorPresenter\Implementation\Formatters\InvalidAttribute;
use OpisErrorPresenter\Implementation\Formatters\Required;
use OpisErrorPresenter\Implementation\MessageFormatterFactory;
use PHPUnit\Framework\TestCase;

class MessageFormatterFactoryTest extends TestCase
{
    public function testShouldCreateMessageFormatter(): void
    {
        $factory = new MessageFormatterFactory;

        $error = $this->createMock(ValidationError::class);
        $error->method('keyword')->willReturn(Keyword::REQUIRED);

        $this->assertInstanceOf(
            Required::class,
            $factory->create($error)
        );
    }

    public function testShouldCreateDefaultMessageFormatter(): void
    {
        $factory = new MessageFormatterFactory;

        $error = $this->createMock(ValidationError::class);
        $error->method('keyword')->willReturn('test');

        $this->assertInstanceOf(
            InvalidAttribute::class,
            $factory->create($error)
        );
    }
}
