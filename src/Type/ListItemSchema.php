<?php

namespace Broarm\Schema\Type;

class ListItemSchema extends SchemaType
{
    public string $type = 'ListItem';
    public int $position;
    public ThingSchema $item;

    public function __construct($position, ThingSchema $item)
    {
        $this->position = (int) $position;
        $this->item = $item;
    }
}