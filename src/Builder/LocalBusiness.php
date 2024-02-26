<?php

namespace Broarm\Schema\Builder;

use Broarm\Schema\Type\GeoCoordinatesSchema;
use Broarm\Schema\Type\LocalBusinessSchema;
use Broarm\Schema\Type\PostalAddressSchema;
use SilverStripe\Control\Director;
use SilverStripe\Core\Config\Config;
use SilverStripe\SiteConfig\SiteConfig;

class LocalBusiness extends SchemaBuilder
{
    /**
     * Create the local business schema object
     *
     * @param Page $page
     *
     * @return LocalBusinessSchema
     */
    public function getSchema($page)
    {
        $siteConfig = SiteConfig::current_site_config();

        $localBusiness = new LocalBusinessSchema(
            Director::absoluteBaseURL(),
            $siteConfig->Title,
            new PostalAddressSchema(
                $siteConfig->getField('Address') ?? '',
                $siteConfig->getField('Suburb') ?? '',
                $siteConfig->getField('State') ?? '',
                $siteConfig->getField('Postcode') ?? '',
                $siteConfig->getField('Country') ?? ''
            ),
            Director::absoluteBaseURL()
        );

        if (SiteConfig::has_extension('Geocodable')) {
            $localBusiness->geo = new GeoCoordinatesSchema(
                $siteConfig->getField('Lat'),
                $siteConfig->getField('Lng')
            );
        }

        if ($telephone = $siteConfig->getField('Phone')) {
            $localBusiness->telephone = $telephone;
        }

        /**
         * You can set the image in your config.yml
         * Schema:
         *  logo: 'path/to/logo.png'
         */
        $localBusiness->image = Director::absoluteBaseURL() . Config::inst()->get('Page', 'default_image');

        return $localBusiness;
    }
}
