<?php

namespace Broarm\Schema\Type;

class EntityOfPageSchema extends SchemaType
{
    public string $type = 'WebPage';
    public string $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}
