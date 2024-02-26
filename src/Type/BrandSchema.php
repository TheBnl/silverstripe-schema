<?php

namespace Broarm\Schema\Type;

class BrandSchema extends SchemaType
{
    public string $type = 'Brand';
    public string $name;

    public function __construct($name) {
        $this->name = $name;
    }
}
