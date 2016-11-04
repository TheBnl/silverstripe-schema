<?php
/**
 * ThingSchema.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

class ThingSchema extends SchemaType
{
    /**
     * ItemSchema constructor.
     *
     * @param $id
     * @param $name
     */
    public function __construct($id, $name)
    {
        $this->{'@id'} = $id;
        $this->name = $name;
    }
}