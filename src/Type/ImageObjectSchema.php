<?php

namespace Broarm\Schema\Type;

class ImageObjectSchema extends SchemaType
{
    public string $type = 'ImageObject';
    public string $url;
    public int $width;
    public int $height;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function setWidth(int $width)
    {
        $this->width = $width;
    }

    public function setHeight(int $height)
    {
        $this->height = $height;
    }
}