<?php
/**
 * PostalAddressSchema.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

namespace Schema\Type;

/**
 * Class PostalAddressSchema
 *
 * @package Schema\Type
 * @property string streetAddress;
 * @property string addressLocality;
 * @property string addressRegion;
 * @property string postalCode;
 * @property string addressCountry;
 */
class PostalAddressSchema extends SchemaType
{
    /**
     * PostalAddressSchema constructor.
     *
     * @param $streetAddress String
     * @param $addressLocality String
     * @param $addressRegion String
     * @param $postalCode String
     * @param $addressCountry String
     */
    public function __construct($streetAddress, $addressLocality, $addressRegion, $postalCode, $addressCountry)
    {
        $this->{'@type'} = 'PostalAddress';
        $this->streetAddress = $streetAddress;
        $this->addressLocality = $addressLocality;
        $this->addressRegion = $addressLocality;
        $this->postalCode = $postalCode;
        $this->addressCountry = $addressCountry;
    }
}