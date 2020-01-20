<?php

namespace Broarm\Schema;

use Broarm\Schema\Builder\SchemaBuilder;
use ClassInfo;
use SS_Object;

/**
 * Schema.php
 *
 * todo move this to the schema extension ?
 *
 * todo make all data types possible
 * https://developers.google.com/search/docs/data-types/breadcrumbs
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 * @deprecated
 */
class Schema extends SS_Object
{
    //private static $logo = 'schema/images/default.png';

    /**
     * Array of schema items set per page
     *
     * @var array
     */
    //private static $config = array();

    /**
     * Get the schema config for the given class name
     *
     * @param $className
     * @return mixed
     * /
    public static function get_schema_config($className)
    {
        $classes = array_reverse(ClassInfo::dataClassesFor($className));
        $configs = self::config()->get('config');
        $out = array();
	    
        foreach ($classes as $key => $className) {
            if (!empty($configs[$className])) {
                $out = array_merge($out, $configs[$className]);
            }
        }

        return array_unique($out);
    } //*/

    /**
     * Check
     *
     * @param $schema
     * @return bool
     * /
    public static function is_valid($schema)
    {
        return class_exists($schema) && new $schema() instanceof SchemaBuilder;
    } //*/

}
