<?php

namespace Broarm\Schema\Type;

class ListItemSchema extends SchemaType
{
    public string $type = 'ListItem';
    public string $position;
    public ThingSchema $item;

    public function __construct($position, ThingSchema $item)
    {
        $this->position = $position;
        $this->item = $item;
    }
}