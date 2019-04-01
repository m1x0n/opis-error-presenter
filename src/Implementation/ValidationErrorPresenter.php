<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts;

/**
 * Class ValidationErrorPresenter
 * @package OpisErrorPresenter\Implementation
 */
class ValidationErrorPresenter implements Contracts\ValidationErrorPresenter
{
    /**
     * @var PresentedValidationErrorFactory
     */
    private $presentedErrorFactory;

    public function __construct(PresentedValidationErrorFactory $factory)
    {
        $this->presentedErrorFactory = $factory;
    }

    /**
     * @param ValidationError[] ...$errors
     * @return array
     */
    public function present(ValidationError ...$errors): array
    {
        $presented = [];

        foreach ($errors as $error) {
            if (!$error->subErrorsCount()) {
                $presented[] = $this->presentedErrorFactory->create($error);
            } else {
                $presented[] = $this->present(...$error->subErrors());
            }
        }

        return array_reduce($presented, function($carry, $item) {
            return is_array($item)
                ? array_merge($carry, ...$item)
                : array_merge($carry, [$item]);
        }, []);
    }
}
