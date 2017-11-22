<?php

namespace Broarm\Schema\Type;

/**
 * Class ImageObjectSchema
 *
 * @author Bram de Leeuw
 * Date: 10/07/17
 *
 * @package Broarm\Schema\Type
 *
 * @property string url
 * @property int    width
 * @property int    height
 */
class ImageObjectSchema extends SchemaType
{
    /**
     * ImageObjectSchema constructor.
     *
     * @param string $url
     * @param int    $width
     * @param int    $height
     */
    public function __construct($url, $width = null, $height = null)
    {
        $this->{'@type'} = 'ImageObject';
        $this->url = $url;
        $this->width = $width;
        $this->height = $height;
    }
}