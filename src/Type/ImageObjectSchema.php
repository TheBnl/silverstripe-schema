<?php

namespace Broarm\Schema\Type;

class ImageObjectSchema extends SchemaType
{
    public string $type = 'ImageObject';
    public string $url;
    public string|null $width;
    public string|null $height;

    public function __construct($url, $width = null, $height = null)
    {
        $this->{'@type'} = 'ImageObject';
        $this->url = $url;
        $this->width = $width;
        $this->height = $height;
    }
}