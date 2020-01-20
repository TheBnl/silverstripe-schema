<?php
/**
 * SchemaBuilder.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

namespace Broarm\Schema\Builder;

use SS_Object;


/**
 * SchemaBuilder
 */
abstract class SchemaBuilder extends SS_Object {

    /**
     * Get the schema from the given data
     *
     * @param $page
     */
    abstract public function getSchema($page);

}