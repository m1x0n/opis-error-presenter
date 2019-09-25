<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class OneOf extends Formatter
{
    public const MESSAGE = 'The attribute must match exactly one of the subschemas.';
}
