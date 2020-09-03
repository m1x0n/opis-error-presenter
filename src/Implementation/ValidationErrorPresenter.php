<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation;

use Opis\JsonSchema\ValidationError;
use OpisErrorPresenter\Contracts;
use OpisErrorPresenter\Implementation\Strategies\AllErrors;

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

    /**
     * @var Contracts\PresentStrategy
     */
    private $presentStrategy;

    public function __construct(
        PresentedValidationErrorFactory $factory,
        ?Contracts\PresentStrategy $presentStrategy = null
    ) {
        $this->presentedErrorFactory = $factory;
        $this->presentStrategy = $presentStrategy ?: new AllErrors();
    }

    /**
     * @param ValidationError[] $errors
     * @return array
     */
    public function present(ValidationError ...$errors): array
    {
        $collected = $this->collect(...$errors);

        return $this->presentStrategy->execute(...$collected);
    }

    private function collect(ValidationError ...$errors): array
    {
        $presented = [];

        foreach ($errors as $error) {
            $presented[] = $this->presentedErrorFactory->create($error);

            if ($error->subErrorsCount()) {
                $presented[] = $this->collect(...$error->subErrors());
            }
        }

        return array_reduce($presented, function ($carry, $item) {
            return is_array($item)
                ? array_merge_recursive($carry, $item)
                : array_merge($carry, [$item]);
        }, []);
    }
}
