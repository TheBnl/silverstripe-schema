<?php
/**
 * ListItemSchema.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

namespace Schema\Type;

/**
 * Class ListItemSchema
 * @package Schema\Type
 * @property string position
 * @property string item
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