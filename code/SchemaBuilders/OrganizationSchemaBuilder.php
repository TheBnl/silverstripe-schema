<?php
/**
 * OrganizationSchemaBuilder.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */


/**
 * Class OrganizationSchemaBuilder
 */
class OrganizationSchemaBuilder extends SchemaBuilder {

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
        if ($siteConfig->SocialMediaPlatforms()->Count()) {
            foreach ($siteConfig->SocialMediaPlatforms() as $platform) {
                array_push($organization->sameAs, $platform->URL);
            }
        }

        return $organization;
    }
}
