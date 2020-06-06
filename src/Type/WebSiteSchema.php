<?php
/**
 * WebSiteSchema.php
 *
 * @author Bram de Leeuw
 * Date: 04/11/16
 */

namespace Broarm\Schema\Type;

/**
 * Class WebSiteSchema
 *
 * @property string alternateName
 * @property string potentialAction
 * @property string name
 * @property string url
 */
class WebSiteSchema extends SchemaType
{
    /**
     * WebSiteSchema constructor.
     *
     * @param string $name
     * @param string $url
     */
    public function __construct($name, $url)
    {
        $this->{'@context'} = 'http://schema.org';
        $this->{'@type'} = 'WebSite';
        $this->name = $name;
        $this->url = $url;
    }
}