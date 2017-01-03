<?php

namespace Schema;

use Schema\Builder\SchemaBuilder;
use SilverStripe\Core\ClassInfo;
use SilverStripe\Core\Config\Config;


/**
 * Schema.php
 *
 * todo make all data types possible
 * https://developers.google.com/search/docs/data-types/breadcrumbs
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */
class Schema
{

    private static $logo = 'schema/images/default.png';

    /**
     * Get the schema config for the given class name
     *
     * @param $className
     * @return mixed
     */
    public static function get_schema_config($className)
    {
        $classes = array_reverse(ClassInfo::dataClassesFor($className));
        $configs = self::get_config('config');
        $out = array();
	    
        foreach ($classes as $key => $className) {
            if (!empty($configs[$className])) {
                $out = array_merge($out, $configs[$className]);
            }
        }

        return array_unique($out);
    }


    /**
     * Get a config value
     *
     * @param $value
     * @return array
     */
    public static function get_config($value)
    {
        return Config::inst()->get('Schema\Schema', $value);
    }


    /**
     * Check
     *
     * @param $schema
     * @return bool
     */
    public static function is_valid($schema)
    {
        return class_exists($schema) && new $schema() instanceof SchemaBuilder;
    }

}
