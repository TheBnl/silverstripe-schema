<?php

namespace Broarm\Schema\Type;

class ContactPointSchema extends SchemaType
{
    public string $type = 'ContactPoint';
    public string $telephone;
    public string $contactType;
    public array $contactOption = [];

    private static $contact_options = [
        'TollFree',
        'HearingImpairedSupported'
    ];

    private static $contact_types = [
        'customer service',
        'technical support',
        'billing support',
        'bill payment',
        'sales',
        'reservations',
        'credit card support',
        'emergency',
        'baggage tracking',
        'roadside assistance',
        'package tracking'
    ];

    public function __construct($phone, $contactType)
    {
        $this->telephone = $phone;
        $this->setContactType($contactType);
    }

    public function addContactOption($contactOption) {
        if (!in_array($contactOption, self::$contact_options)) {
            trigger_error("Invalid contact option: $contactOption", E_USER_ERROR);
        }

        array_push($this->contactOption, $contactOption);
    }

    public function setContactType($contactType) {
        if (!in_array($contactType, self::$contact_types)) {
            trigger_error("Invalid contact type: $contactType", E_USER_ERROR);
        }

        $this->contactType = $contactType;
    }
}
