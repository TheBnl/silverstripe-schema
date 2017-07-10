<?php
/**
 * GeoCoordinatesSchema.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

namespace Broarm\Schema\Type;

/**
 * Class GeoCoordinatesSchema
 * @package Broarm\Schema\Type
 * @property float latitude;
 * @property float longitude;
 */
class GeoCoordinatesSchema extends SchemaType
{
    /**
     * GeoCoordinatesSchema constructor.
     *
     * @param $latitude Float
     * @param $longitude Float
     */
    public function __construct($latitude, $longitude)
    {
        $this->{'@type'} = 'GeoCoordinates';
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
}