<?php
/**
 * SchemaBuilder.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */
 
 
/**
 * SchemaBuilder
 */
abstract class SchemaBuilder extends Object {

    /**
     * Get the schema from the given data
     *
     * @param $page
     */
    abstract public function getSchema($page);

}