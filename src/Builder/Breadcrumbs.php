<?php

namespace Broarm\Schema\Builder;

use Broarm\Schema\Type\BreadcrumbListSchema;

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
