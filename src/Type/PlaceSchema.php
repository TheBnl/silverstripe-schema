<?php

namespace Broarm\Schema\Type;

/**
 * schema.org/Place (e.g. an Event location). Nested type — no @context of its own.
 *
 * @package Broarm\Schema\Type
 */
class PlaceSchema extends SchemaType
{
    public string $type = 'Place';

    public ?string $name = null;
    public ?PostalAddressSchema $address = null;
    public ?string $url = null;
    public ?GeoCoordinatesSchema $geo = null;

    public function __construct(?string $name = null, ?PostalAddressSchema $address = null)
    {
        $this->name = $name ?: null;
        $this->address = $address;
    }
}
