<?php

namespace Broarm\Schema\Type;

/**
 * Class BrandSchema
 * @author Bram de Leeuw
 * Date: 10/07/17
 *
 * @package Broarm\Schema\Type
 *
 * @property string name
 */
class BrandSchema extends SchemaType
{
    public function __construct($name) {
        $this->{'@type'} = 'Brand';
        $this->name = $name;
    }
}
