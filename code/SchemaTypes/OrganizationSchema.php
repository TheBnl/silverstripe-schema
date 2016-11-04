<?php
/**
 * OrganizationSchema.php
 *
 * @author Bram de Leeuw
 * Date: 04/11/16
 */

/**
 * Class OrganizationSchema
 * @property array contactPoint
 * @property array sameAs
 */
class OrganizationSchema extends SchemaType
{
    /**
     * OrganizationSchema constructor.
     *
     * @param string $url
     * @param string $logo
     */
    public function __construct($url, $logo)
    {
        $this->{'@context'} = 'http://schema.org';
        $this->{'@type'} = 'Organization';
        $this->url = $url;
        $this->logo = $logo;
    }

    /**
     * Add one or more contact points to the organization
     *
     * @param ContactPointSchema|array $contactPoint
     */
    public function addContactPoint($contactPoint) {
        if (!isset($this->contactPoint)) $this->contactPoint = array();
        array_push($this->contactPoint, $contactPoint);
    }
}