<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts\Keyword;
use OpisErrorPresenter\Contracts\MessageFormatter;
use OpisErrorPresenter\Implementation\Formatters\DefaultFormatter;
use OpisErrorPresenter\Implementation\Formatters\FormatFormatter;

class MessageFormatterFactory
{
    public function create(ValidationError $error): MessageFormatter
    {
        switch ($error->keyword()) {
            case Keyword::FORMAT:
                return new FormatFormatter;
                break;
            default:
                return new DefaultFormatter;
        }
    }
}
