<?php

namespace Broarm\Schema\Type;

class SearchActionSchema extends SchemaType
{
    public string $type = 'SearchAction';
    public string $target;
    public string $queryInput; // FIXME: google uses query-input ?

    public function __construct(string $target, string $queryInput)
    {
        $this->target = $target;
        $this->queryInput = $queryInput;
    }
}
