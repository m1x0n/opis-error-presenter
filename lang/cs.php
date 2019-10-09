<?php
declare(strict_types=1);

use OpisErrorPresenter\Contracts\Keyword;

return [
    Keyword::TYPE                  => "Typ atributu je ':used:', ale má být ':expected:'.",
    Keyword::ENUM                  => "Atribut musí mít jednu z následujících hodnot: :expected:.",
    Keyword::CONST                 => "Hodnota atributu musí být ':expected:'.",
    Keyword::FORMAT                => "Hodnota atributu musí mít formát ':format:'.",
    Keyword::MULTIPLE_OF           => "Hodnota atributu musí být násobkem :divisor:.",
    Keyword::MAXIMUM               => "Hodnota atributu musí být rovna nebo menší než :max:.",
    Keyword::EXCLUSIVE_MAXIMUM     => "Hodnota atributu musí být menší než :max:.",
    Keyword::MINIMUM               => "Hodnota atributu musí být rovna nebo větší než :min:.",
    Keyword::EXCLUSIVE_MINIMUM     => "Hodnota atributu musí být větší než :min:.",
    Keyword::MAX_LENGTH            => "Hodnota atributu nemůže mít více znaků než :max:.",
    Keyword::MIN_LENGTH            => "Hodnota atributu nemůže mít méně znaků než :min:.",
    Keyword::PATTERN               => "Hodnota atributu má neplatný formát.",
    Keyword::ITEMS                 => "Atribut obsahuje neplatné položky.",
    Keyword::ADDITIONAL_ITEMS      => "Atribut nemůže obsahovat dodatečné položky.",
    Keyword::MIN_ITEMS             => "Počet položek atributu je :count:, ale minimum je :min.",
    Keyword::MAX_ITEMS             => "Počet položek atributu je :count:, ale maximum je :max.",
    Keyword::UNIQUE_ITEMS          => "Atribut obsahuje duplicitní položku: ':duplicate:'.",
    Keyword::CONTAINS              => "Atribut obsahuje neplatné položky.",
    Keyword::MIN_PROPERTIES        => "Počet vlastností atributu je :count:, ale minimum je :min:.",
    Keyword::MAX_PROPERTIES        => "Počet vlastností atributu je :count:, ale maximum je :max.",
    Keyword::REQUIRED              => "Atribut musí obsahovat vlastnost ':missing:'.",
    Keyword::PATTERN_PROPERTIES    => "Vlastnost má neplatný formát.",
    Keyword::DEPENDENCIES          => "Atribut musí obsahovat vlastnost ':missing:'.",
    Keyword::PROPERTY_NAMES        => "Vlastnost ':property:' má neplatný formát.",
    Keyword::ADDITIONAL_PROPERTIES => "Atribut nemůže obsahovat dodatečné vlastnosti.",
    Keyword::THEN                  => "Atribut neodpovídá schématu pro 'then'.",
    Keyword::ELSE                  => "Atribut neodpovídá schématu pro 'else'.",
    Keyword::ALL_OF                => "Atribut musí odpovídat všem subschématům.",
    Keyword::ANY_OF                => "Atribut neodpovídá žádnému ze subschémat.",
    Keyword::ONE_OF                => "Atribut musí odpovídat právě jednomu ze subschémat.",
    Keyword::NOT                   => "Atribut je neplatný.",
];
