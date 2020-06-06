<?php
/**
 * SearchActionSchema.php
 *
 * @author Bram de Leeuw
 * Date: 04/11/16
 */

namespace Broarm\Schema\Type;

/**
 * Class SearchActionSchema
 *
 * @package Broarm\Schema\Type
 * @property string target
 */
class SearchActionSchema extends SchemaType
{
    public function __construct($target, $queryInput)
    {
        $this->{'@type'} = 'SearchAction';
        $this->target = $target;
        $this->{'query-input'} = $queryInput;
    }
}