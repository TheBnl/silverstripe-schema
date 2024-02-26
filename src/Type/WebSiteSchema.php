<?php

namespace Broarm\Schema\Type;

class WebSiteSchema extends SchemaType
{
    public string $context = 'http://schema.org';
    public string $type = 'WebSite';
    public string $name;
    public string $url;
    public SearchActionSchema $potentialAction;

    public function __construct($name, $url)
    {
        $this->name = $name;
        $this->url = $url;
    }
}