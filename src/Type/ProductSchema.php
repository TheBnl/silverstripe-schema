<?php

namespace Broarm\Schema\Type;

class ProductSchema extends SchemaType
{
    public string $context = 'http://schema.org';
    public string $type = 'Product';
    public string $name;
    public string $description;
    public OfferSchema $offers;
    public string $sku;
    public string $gtin;
    public BrandSchema $brand;
    public array $image;

    public function __construct($name, $description, OfferSchema $offer) {
        $this->name = $name;
        $this->description = $description;
        $this->offers = $offer;
    }

    public function setSku(string $sku)
    {
        $this->sku = $sku;
    }

    public function setGtin(string $gtin)
    {
        $this->gtin = $gtin;
    }

    public function setBrand(BrandSchema $brand)
    {
        $this->brand = $brand;
    }

    public function setImage(array $images)
    {
        $this->image = $images;
    }
}
