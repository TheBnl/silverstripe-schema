<?php
/**
 * SchemaBuilder.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

namespace Broarm\Schema;

use Spatie\SchemaOrg\Base;
use Spatie\SchemaOrg\BaseType;

/**
 * SchemaBuilder
 */
abstract class SchemaBuilder
{
    /**
     * Get the schema from the given data
     *
     * @param $page
     * @return BaseType|array
     */
    abstract public function getSchema($page);
}
