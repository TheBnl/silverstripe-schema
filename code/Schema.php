<?php
/**
 * Schema.php
 *
 * make all data types possible
 * https://developers.google.com/search/docs/data-types/breadcrumbs
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

class Schema {

    private static $logo = 'schema/images/default.png';

    /**
     * Get the schema config for the given class name
     *
     * @param $className
     * @return mixed
     */
    public static function get_schema_config($className) {
        $configs = self::get_config('config');

	    $classes = array_reverse(ClassInfo::dataClassesFor($className));

	    $out = array();
	    foreach($classes as $key => $className) {
		    if(!empty($configs[$className])) {
			    array_push($out, $configs[$className]);
		    }
	    }
        return $out;
    }


    public static function get_config($value) {
        return Config::inst()->get('Schema', $value);
    }
    
}
