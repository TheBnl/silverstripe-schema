<?php
/**
 * Organization.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

namespace Schema\Builder;
use Page;
use Schema\Schema;
use Schema\Type\ContactPointSchema;
use Schema\Type\OrganizationSchema;
use SilverStripe\Control\Director;
use SilverStripe\SiteConfig\SiteConfig;

/**
 * Class Organization
 */
class Organization extends SchemaBuilder {

    /**
     * Create the organization schema object
     *
     * @param Page $page
     * @return OrganizationSchema
     */
    public function getSchema($page)
    {
        $siteConfig = SiteConfig::current_site_config();

        $organization = new OrganizationSchema(
            Director::absoluteBaseURL(),
            Director::absoluteBaseURL() . Schema::get_config('logo')
        );

        // TODO: make more generic
        $organization->addContactPoint($point = new ContactPointSchema(
            $siteConfig->getField('Phone'),
            'customer service'
        ));

        // TODO make this more generic
        if (class_exists('SocialMediaPlatform') && $siteConfig->SocialMediaPlatforms() && $siteConfig->SocialMediaPlatforms()->Count()) {
            foreach ($siteConfig->SocialMediaPlatforms() as $platform) {
                $organization->addSameAs($platform->URL);
            }
        }

        return $organization;
    }
}
