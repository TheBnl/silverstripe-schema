<?php
/**
 * OrganizationSchema.php
 *
 * @author Bram de Leeuw
 * Date: 04/11/16
 */

namespace Broarm\Schema\Type;

/**
 * Class OrganizationSchema
 *
 * @property string            name
 * @property string            url
 * @property ImageObjectSchema logo
 */
class OrganizationSchema extends SchemaType
{
    /**
     * OrganizationSchema constructor.
     *
     * @param                   $name
     * @param                   $url
     * @param ImageObjectSchema $logo
     */
    public function __construct($name, $url, ImageObjectSchema $logo)
    {
        $this->{'@context'} = 'http://schema.org';
        $this->{'@type'} = 'Organization';
        $this->name = $url;
        $this->url = $url;
        $this->logo = $logo;
    }

    /**
     * Add one or more contact points to the organization
     *
     * @param ContactPointSchema|array $contactPoint
     */
    public function addContactPoint($contactPoint)
    {
        if (!isset($this->contactPoint)) {
            $this->contactPoint = array();
        }
        array_push($this->contactPoint, $contactPoint);
    }

    /**
     * Add a same as social media reference
     *
     * @param $sameAs
     */
    public function addSameAs($sameAs)
    {
        if (!isset($this->sameAs)) {
            $this->contactPoint = array();
        }
        array_push($this->sameAs, $sameAs);
    }
}
