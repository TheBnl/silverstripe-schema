<?php
/**
 * ThingSchema.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

namespace Broarm\Schema\Type;

/**
 * Class EntityOfPageSchema
 * @author Bram de Leeuw
 * Date: 10/07/17
 *
 * @package Broarm\Schema\Type
 */
class EntityOfPageSchema extends SchemaType
{
    /**
     * EntityOfPageSchema constructor.
     *
     * @param $id
     */
    public function __construct($id)
    {
        $this->{'@type'} = 'WebPage';
        $this->{'@id'} = $id;
    }
}