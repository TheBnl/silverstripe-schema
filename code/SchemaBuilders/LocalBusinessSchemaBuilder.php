<?php
/**
 * LocalBusinessSchemaBuilder.php
 *
 * @author Bram de Leeuw
 * Date: 04/11/16
 */


/**
 * Class LocalBusinessSchemaBuilder
 */
class LocalBusinessSchemaBuilder extends SchemaBuilder {

    /**
     * Create the local business schema object
     *
     * @param Page $object
     * @return LocalBusinessSchema
     */
    public static function get_schema($object)
    {
        $siteConfig = SiteConfig::current_site_config();

        $localBusiness = new LocalBusinessSchema(
            Director::absoluteBaseURL(),
            $siteConfig->getField('Title'),
            new PostalAddressSchema(
                $siteConfig->getField('Address'),
                $siteConfig->getField('Suburb'),
                $siteConfig->getField('State'),
                $siteConfig->getField('Postcode'),
                $siteConfig->getField('Country')
            ),
            Director::absoluteBaseURL()
        );


        // todo check if geocodable is defined
        echo "<pre>";
        print_r('has geo ' . SiteConfig::has_extension('Geocodable') ? 'ja' : 'nee');
        echo "</pre>";
        exit();
        $localBusiness->geo = new GeoCoordinatesSchema(
            $siteConfig->getField('Lat'),
            $siteConfig->getField('Lng')
        );


        // todo check if field exists
        $localBusiness->telephone = $siteConfig->getField('Phone');


        /**
         * You can set the image in your config.yml
         * Schema:
         *  logo: 'path/to/logo.png'
         */
        $localBusiness->image = Director::absoluteBaseURL() . Schema::get_config('logo');

        return $localBusiness;
    }
}
