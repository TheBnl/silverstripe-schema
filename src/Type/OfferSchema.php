<?php

namespace Broarm\Schema\Type;

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
    
    public string $context = 'https://schema.org';
    public string $type = 'Offer';
    public string $price;
    public string $priceCurrency;
    public string $availability;

    // Optional (omitted from output when left null).
    public ?string $url = null;
    public ?string $itemCondition = null;
    public ?string $priceValidUntil = null;

    public function __construct($price, $priceCurrency, $availability) {
        $this->price = $price;
        $this->priceCurrency = $priceCurrency ;
        $this->availability = $availability;
    }
}
