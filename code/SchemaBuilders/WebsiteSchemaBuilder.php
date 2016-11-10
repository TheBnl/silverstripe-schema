<?php
/**
 * WebsiteSchemaBuilder.php
 *
 * @author Bram de Leeuw
 * Date: 04/11/16
 */


/**
 * Class WebsiteSchemaBuilder
 */
class WebsiteSchemaBuilder extends SchemaBuilder {

    /**
     * Create the website schema object
     *
     * @param Page $object
     * @return WebSiteSchema
     */
    public static function get_schema($object)
    {
        $siteConfig = SiteConfig::current_site_config();

        $website = new WebSiteSchema(
            $siteConfig->getField('Title'),
            Director::absoluteBaseURL()
        );

        // add a search box if Fulltext search is enabled
        if (is_array(FulltextSearchable::get_searchable_classes())) {
            $website->potentialAction = new SearchActionSchema(
                Director::absoluteBaseURL() . 'SearchForm?Search={search_term_string}',
                'required name=search_term_string'
            );
        }

        return $website;
    }
}