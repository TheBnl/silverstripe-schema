<?php

namespace Broarm\Schema\Type;

/**
 * Class ProductSchema
 *
 * @author Bram de Leeuw
 * Date: 10/07/17
 *
 * @package Broarm\Schema\Type
 *
 * @property string name
 * @property string description
 * @property string sku
 * @property string gtin
 * @property BrandSchema brand
 * @property OfferSchema offers
 */
class ProductSchema extends SchemaType
{
    public function __construct($name, $description, OfferSchema $offer, $sku = null, $gtin = null, BrandSchema $brand = null, $images = []) {
        $this->{'@context'} = 'http://schema.org';
        $this->{'@type'} = 'Product';
        $this->name = $name;
        $this->description = $description;
        $this->sku = $sku;
        $this->gtin = $gtin;
        $this->brand = $brand;
        $this->offers = $offer;
        $this->images = $images;
    }
}
