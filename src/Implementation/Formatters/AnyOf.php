<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class AnyOf extends Formatter
{
    public const MESSAGE = 'The attribute does not match any of the subschemas.';
}
