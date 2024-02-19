<?php
/**
 * SchemaBuilder.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

namespace Broarm\Schema;

/**
 * SchemaBuilder
 */
abstract class SchemaBuilder
{
    /**
     * Get the schema from the given data
     *
     * @param $page
     */
    abstract public function getSchema($page);





}
