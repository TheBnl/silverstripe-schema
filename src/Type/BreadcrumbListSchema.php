<?php

namespace Broarm\Schema\Type;

use SilverStripe\ORM\ArrayList;

class BreadcrumbListSchema extends SchemaType
{
    public string $context = 'http://schema.org';
    public string $type = 'BreadcrumbList';
    public array $itemListElement = [];

    public function __construct(ArrayList $breadcrumbs = null)
    {
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
