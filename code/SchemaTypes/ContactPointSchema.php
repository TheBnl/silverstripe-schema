<?php
/**
 * ContactPointSchema.php
 *
 * @author Bram de Leeuw
 * Date: 04/11/16
 */

namespace Broarm\Schema\Type;

/**
 * Class ContactPointSchema
 * @property array contactOption
 *
 * TODO: handle the following properties
 * @property array areaServed
 * @property array availableLanguage
 * @property string telephone
 * @property string contactType
 */
class ContactPointSchema extends SchemaType
{
    private static $contact_options = array(
        'TollFree',
        'HearingImpairedSupported'
    );

    private static $contact_types = array(
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
    );


    /**
     * ContactPointSchema constructor.
     *
     * @param $phone
     * @param $contactType
     */
    public function __construct($phone, $contactType)
    {
        $this->{'@type'} = 'ContactPoint';
        $this->telephone = $phone;
        $this->contactType = $this->setContactType($contactType);
    }


    /**
     * Add a contact option
     *
     * @param $contactOption
     */
    public function addContactOption($contactOption) {
        if (!in_array($contactOption, self::$contact_options)) {
            trigger_error("Invalid contact option: $contactOption", E_USER_ERROR);
        }

        if (!isset($this->contactOption)) $this->contactOption = array();
        array_push($this->contactOption, $contactOption);
    }


    /**
     * Check if the contact type is valid
     *
     * @param $contactType
     * @return mixed
     */
    private function setContactType($contactType) {
        if (!in_array($contactType, self::$contact_types)) {
            trigger_error("Invalid contact type: $contactType", E_USER_ERROR);
        }

        return $contactType;
    }
}