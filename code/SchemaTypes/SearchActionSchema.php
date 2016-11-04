<?php
/**
 * SearchActionSchema.php
 *
 * @author Bram de Leeuw
 * Date: 04/11/16
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