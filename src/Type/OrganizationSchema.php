<?php

namespace Broarm\Schema\Type;

class OrganizationSchema extends SchemaType
{
    public string $context = 'http://schema.org';
    public string $type = 'Organization';
    public string $name;
    public string $url;
    public ImageObjectSchema $logo;
    public array $contactPoint = [];
    public array $sameAs = [];

    public function __construct(string $name, string $url, ImageObjectSchema $logo)
    {
        $this->name = $name;
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
        array_push($this->contactPoint, $contactPoint);
    }

    /**
     * Add a same as social media reference
     *
     * @param $sameAs
     */
    public function addSameAs($sameAs)
    {
        array_push($this->sameAs, $sameAs);
    }
}
