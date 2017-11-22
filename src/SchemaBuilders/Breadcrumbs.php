<?php
/**
 * Breadcrumbs.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

namespace Broarm\Schema\Builder;

use Broarm\Schema\Type\BreadcrumbListSchema;

/**
 * Class Breadcrumbs
 */
class Breadcrumbs extends SchemaBuilder
{

    /**
     * Create the breadcrumb schema object
     *
     * @param Page $page
     *
     * @return BreadcrumbListSchema
     */
    public function getSchema($page)
    {
        $breadcrumbList = $page->getBreadcrumbItems();
        if ($breadcrumbList->count() > 1) {
            return new BreadcrumbListSchema($breadcrumbList);
        } else {
            return null;
        }
    }
}
