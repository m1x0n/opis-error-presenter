<?php

declare(strict_types=1);

namespace OpisErrorPresenter\Implementation\Formatters;

class UniqueItems extends Formatter
{
    public const MESSAGE = "The attribute contains duplicated item: ':duplicate:'.";

    public function replacements(): array
    {
    	if (is_string($this->error->keywordArgs()['duplicate'])) {
            return [
                ':duplicate:' => $this->error->keywordArgs()['duplicate']
            ];
        } elseif (json_encode($this->error->keywordArgs()['duplicate'])) {
            return [
                ':duplicate:' => json_encode($this->error->keywordArgs()['duplicate'])
            ];
        } else {
            return [':duplicate:' => ''];
        }
    }
}
