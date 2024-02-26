<?php

namespace Broarm\Schema\Type;

class GeoCoordinatesSchema extends SchemaType
{
    public string $type = 'GeoCoordinates';
    public string $latitude;
    public string $longitude;

    public function __construct($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
}