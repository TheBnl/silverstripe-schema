<?php
/**
 * Website.php
 *
 * @author Bram de Leeuw
 * Date: 04/11/16
 */

namespace Broarm\Schema\Builder;

use Broarm\Schema\SchemaBuilder;
use SilverStripe\Control\Director;
use SilverStripe\SiteConfig\SiteConfig;
use Spatie\SchemaOrg\WebSite as SchemaOrgWebSite;

/**
 * Class Website
 */
class Website extends SchemaBuilder
{
    /**
     * Create the website schema object
     *
     * @param \Page $page
     *
     **/
    public function getSchema($page): ?SchemaOrgWebSite
    {
        $siteConfig = SiteConfig::current_site_config();

        $website = new SchemaOrgWebSite();
        $website->name($siteConfig->Title);
        $website->url(Director::absoluteBaseURL());

        return $website;
    }
}
