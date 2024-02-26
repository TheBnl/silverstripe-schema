<?php
/**
 * PostalAddressSchema.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

namespace Broarm\Schema\Type;

class PostalAddressSchema extends SchemaType
{
    public string $type = 'PostalAddress';

    public string $streetAddress;
    public string $addressLocality;
    public string $addressRegion;
    public string $postalCode;
    public string $addressCountry;

    public function __construct(string $streetAddress, string $addressLocality, string $addressRegion, string $postalCode, string $addressCountry)
    {
        $this->streetAddress = $streetAddress;
        $this->addressLocality = $addressLocality;
        $this->addressRegion = $addressRegion;
        $this->postalCode = $postalCode;
        $this->addressCountry = $addressCountry;
    }
}