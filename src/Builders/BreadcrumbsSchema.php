<?php
/**
 * Breadcrumbs.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

namespace Broarm\Schema\Builders;

use Broarm\Schema\SchemaBuilder;
use Spatie\SchemaOrg\BreadcrumbList;
use Spatie\SchemaOrg\ListItem;

/**
 * Class Breadcrumbs
 */
class BreadcrumbsSchema extends SchemaBuilder
{
    /**
     * Create the breadcrumb schema object
     *
     * @param Page $page
     *
     * @return BreadcrumbList|null
     */
    public function getSchema($page): ?BreadcrumbList
    {
        $breadcrumbList = $page->getBreadcrumbItems();
        if ($breadcrumbList->count() > 1) {
            $obj = new BreadcrumbList();
            foreach ($breadcrumbList as $pos => $page) {
                $breadcrumb = new ListItem();
                $breadcrumb->name($page->Title);
                $breadcrumb->position($pos + 1);
                $breadcrumb->url($page->AbsoluteLink());
                $breadcrumbs[] = $breadcrumb;
            }
            $obj->itemListElement($breadcrumbs);
            return $obj;
        }
        return null;
    }
}
