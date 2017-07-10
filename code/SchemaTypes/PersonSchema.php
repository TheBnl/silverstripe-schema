<?php

namespace Broarm\Schema\Type;

/**
 * Class PersonSchema
 * @author Bram de Leeuw
 * Date: 10/07/17
 *
 * @package Broarm\Schema\Type
 *
 * @property string name
 */
class PersonSchema extends SchemaType
{
    /**
     * PersonSchema constructor.
     *
     * @param $name
     */
    public function __construct($name)
    {
        $this->{'@type'} = 'Person';
        $this->name = $name;
    }
}