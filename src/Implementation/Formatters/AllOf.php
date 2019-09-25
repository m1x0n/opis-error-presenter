<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class AllOf extends Formatter
{
    public const MESSAGE = 'The attribute must be valid against all of the subschemas.';
}
