<?php

namespace Broarm\Schema\Type;

class PersonSchema extends SchemaType
{
    public string $type = 'Person';
    public string $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}