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
     * @param Page $page
     * @return BreadcrumbListSchema
     */
    public function getSchema($page)
    {
        $breadcrumbList = $page->getBreadcrumbItems();
	    if($breadcrumbList->count() > 1) {
            return new BreadcrumbListSchema($breadcrumbList);
	    } else {
            return null;
        }
    }
}
