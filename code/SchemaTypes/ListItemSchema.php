<?php
/**
 * ListItemSchema.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

class ListItemSchema extends SchemaType
{
    /**
     * ListItemSchema constructor.
     *
     * @param $position
     * @param ThingSchema $item
     */
    public function __construct($position, ThingSchema $item)
    {
        $this->{'@type'} = 'ListItem';
        $this->position = $position;
        $this->item = $item;
    }
}