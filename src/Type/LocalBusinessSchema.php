<?php

namespace Broarm\Schema\Type;

class LocalBusinessSchema extends SchemaType
{
    public string $context = 'http://schema.org';
    public string $type = 'LocalBusiness';
    public string $id;
    public string $name;
    public PostalAddressSchema $address;
    public string $url;
    public string $telephone;
    public string $image;
    public GeoCoordinatesSchema $geo;

    public function __construct(string $id, string $name, PostalAddressSchema $address, string $url)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->url = $url;
    }
}