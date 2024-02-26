<?php

namespace Broarm\Schema\Type;

class ThingSchema extends SchemaType
{
    public string $id;
    public string $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}