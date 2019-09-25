<?php
declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Strategies;

use OpisErrorPresenter\Contracts\Keyword;
use OpisErrorPresenter\Contracts\PresentedValidationError;
use OpisErrorPresenter\Contracts\PresentStrategy;

/**
 * Class BestMatchError
 *
 * The idea was borrowed from:
 * https://github.com/Julian/jsonschema/blob/master/jsonschema/exceptions.py#L291
 *
 * @package OpisErrorPresenter\Implementation\Strategies
 */
class BestMatchError implements PresentStrategy
{
    public function execute(PresentedValidationError ...$errors): array
    {
        uasort($errors, static function (
            PresentedValidationError $a,
            PresentedValidationError $b
        ) {
            return count($a->pointer()) <=> count($b->pointer());
        });

        foreach ($errors as $error) {
            if (!in_array($error->keyword(), Keyword::WEAK_KEYWORDS, true)) {
                return [$error];
            }
        }

        return [reset($errors)];
    }
}
