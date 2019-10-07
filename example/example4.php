<?php
declare(strict_types=1);

namespace Acme;

use OpisErrorPresenter\Implementation\LocaleLoaders\ArrayLocaleLoader;
use OpisErrorPresenter\Implementation\MessageFormatterFactory;
use OpisErrorPresenter\Implementation\PresentedValidationErrorFactory;
use OpisErrorPresenter\Implementation\Translators\DefaultTranslator;
use OpisErrorPresenter\Implementation\ValidationErrorPresenter;

$presenter = new ValidationErrorPresenter(
    new PresentedValidationErrorFactory(
        new MessageFormatterFactory(),
        new DefaultTranslator(
            (new ArrayLocaleLoader())->addPath('de', '/path_to_lang/lang/de.php')
        )
    )
);

