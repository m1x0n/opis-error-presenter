<?php
declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Strategies;

use OpisErrorPresenter\Contracts\Keyword;
use OpisErrorPresenter\Contracts\PresentedValidationError;
use OpisErrorPresenter\Contracts\PresentStrategy;

class BestMatchError implements PresentStrategy
{
    public function execute(PresentedValidationError ...$errors): array
    {
        https://github.com/Julian/jsonschema/blob/master/jsonschema/exceptions.py#L291

        uasort($errors, static function (
            PresentedValidationError $a, PresentedValidationError $b
        ) {
            return count($a->pointer()) <=> count($b->pointer());
        });

        foreach ($errors as $error) {
            if (!in_array($error->keyword(), Keyword::WEAK_KEYWORDS, true)) {
                return [$error];
            }
        }

        return [$errors[0]];
    }
}
