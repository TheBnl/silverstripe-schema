<?php

namespace Broarm\Schema\Type;

/**
 * Class OfferSchema
 *
 * @author Bram de Leeuw
 * Date: 10/07/17
 *
 * @package Broarm\Schema\Type
 *
 * @property string price
 * @property string priceCurrency
 * @property string availability
 */
class OfferSchema extends SchemaType
{
    const Discontinued = 'https://schema.org/Discontinued';
    const InStock = 'https://schema.org/InStock';
    const InStoreOnly = 'https://schema.org/InStoreOnly';
    const LimitedAvailability = 'https://schema.org/LimitedAvailability';
    const OnlineOnly = 'https://schema.org/OnlineOnly';
    const OutOfStock = 'https://schema.org/OutOfStock';
    const PreOrder = 'https://schema.org/PreOrder';
    const PreSale = 'https://schema.org/PreSale';
    const SoldOut = 'https://schema.org/SoldOut';

    public function __construct($price, $priceCurrency, $availability) {
        $this->{'@context'} = 'http://schema.org';
        $this->{'@type'} = 'Offer';
        $this->price = $price;
        $this->priceCurrency = $priceCurrency ;
        $this->availability = $availability;
    }
}
