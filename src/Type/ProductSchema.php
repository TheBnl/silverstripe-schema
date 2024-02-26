<?php

namespace Broarm\Schema\Type;

class ProductSchema extends SchemaType
{
    public string $context = 'http://schema.org';
    public string $type = 'Product';
    public string $name;
    public string $description;
    public OfferSchema $offers;
    public string|null $sku;
    public string|null $gtin;
    public BrandSchema|null $brand;
    public array $image;

    public function __construct($name, $description, OfferSchema $offer, $sku = null, $gtin = null, BrandSchema $brand = null, $images = []) {
        $this->name = $name;
        $this->description = $description;
        $this->offers = $offer;
        $this->sku = $sku;
        $this->gtin = $gtin;
        $this->brand = $brand;
        $this->image = $images;
    }
}
