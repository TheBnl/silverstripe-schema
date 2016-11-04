<?php
/**
 * BreadcrumbListSchema.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

class BreadcrumbListSchema extends SchemaType
{
    /**
     * BreadcrumbListSchema constructor.
     *
     * @param ArrayList|null $breadcrumbs
     */
    public function __construct(ArrayList $breadcrumbs = null)
    {
        $this->{'@context'} = 'http://schema.org';
        $this->{'@type'} = 'BreadcrumbList';
        $this->itemListElement = array();

        if (isset($breadcrumbs)) {
            $this->makeItemListElement($breadcrumbs);
        }
    }


    /**
     * Construct the breadcrumb list
     *
     * @param ArrayList $breadcrumbs
     */
    private function makeItemListElement(ArrayList $breadcrumbs) {
        foreach ($breadcrumbs as $crumb) {
            $listItem = new ListItemSchema(
                $crumb->getPageLevel(),
                new ThingSchema(
                    $crumb->AbsoluteLink(),
                    $crumb->Title
                )
            );
            array_push($this->itemListElement, $listItem);
        }
    }
}