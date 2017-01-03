<?php
/**
 * LocalBusinessSchema.php
 *
 * @author Bram de Leeuw
 * Date: 04/11/16
 */

namespace Schema\Type;

/**
 * @property GeoCoordinatesSchema geo
 * @property string telephone
 * @property string image
 * @property string name
 * @property string address
 * @property string url
 *
 * TODO: add support for following optional properties
 * potentialAction
 * openingHoursSpecification
 * openingHoursSpecification.opens
 * openingHoursSpecification.closes
 * openingHoursSpecification.dayOfWeek
 * openingHoursSpecification.validFrom
 * openingHoursSpecification.validThrough
 * menu
 * acceptsReservations
 * department
 */
class LocalBusinessSchema extends SchemaType
{
    /**
     * LocalBusinessSchema constructor.
     *
     * @param $id
     * @param $name
     * @param PostalAddressSchema $address
     * @param $url
     */
    public function __construct($id, $name, PostalAddressSchema $address, $url)
    {
        $this->{'@context'} = 'http://schema.org';
        $this->{'@type'} = 'LocalBusiness';
        $this->{'@id'} = $id;
        $this->name = $name;
        $this->address = $address;
        $this->url = $url;
    }
}