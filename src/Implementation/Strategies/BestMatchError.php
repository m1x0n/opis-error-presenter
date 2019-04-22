<?php
declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Strategies;

use OpisErrorPresenter\Contracts\PresentedValidationError;
use OpisErrorPresenter\Contracts\PresentStrategy;

class BestMatchError implements PresentStrategy
{
    public function execute(PresentedValidationError ...$errors): array
    {
        //TODO: implement best match algorithm by excluding weak validators
        https://github.com/Julian/jsonschema/blob/master/jsonschema/exceptions.py#L291
    }
}
