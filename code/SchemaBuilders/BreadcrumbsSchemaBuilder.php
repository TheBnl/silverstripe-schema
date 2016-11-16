<?php
/**
 * BreadcrumbsSchemaBuilder.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */


/**
 * Class BreadcrumbsSchemaBuilder
 */
class BreadcrumbsSchemaBuilder extends SchemaBuilder {

    /**
     * Create the breadcrumb schema object
     *
     * @param Page $object
     * @return BreadcrumbListSchema
     */
    public static function get_schema($object)
    {
        $breadcrumbList = $object->getBreadcrumbItems();
	    if($breadcrumbList->count() <=1) {
		    return false;
	    }
        return new BreadcrumbListSchema($breadcrumbList);
    }
}
