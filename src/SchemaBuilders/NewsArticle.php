<?php

namespace Broarm\Schema\Builder;

use Broarm\Schema\Type\EntityOfPageSchema;
use Broarm\Schema\Type\ImageObjectSchema;
use Broarm\Schema\Type\NewsArticleSchema;
use Broarm\Schema\Type\OrganizationSchema;
use Broarm\Schema\Type\PersonSchema;
use SilverStripe\Control\Director;
use SilverStripe\Core\Config\Config;
use SilverStripe\SiteConfig\SiteConfig;

/**
 * Class NewsArticle
 *
 * @author Bram de Leeuw
 * Date: 10/07/17
 */
class NewsArticle extends SchemaBuilder
{
    /**
     * Create the website schema object
     *
     * @param \Page|\BlogPost $page
     *
     * @return NewsArticleSchema
     */
    public function getSchema($page)
    {
        if (($credits = $page->getCredits()) && $credits->exists()) {
            $author = $credits->first()->Name;
        } else {
            $author = SiteConfig::current_site_config()->Title;
        }

        $newsArticle = new NewsArticleSchema(
            $page->Title,
            $page->PublishDate,
            $page->LastEdited,
            $page->dbObject('Content')->FirstParagraph(),
            new EntityOfPageSchema($page->AbsoluteLink()),
            new PersonSchema($author),
            new OrganizationSchema(
                SiteConfig::current_site_config()->Title,
                Director::absoluteBaseURL(),
                new ImageObjectSchema(
                    Director::absoluteBaseURL() . Config::inst()->get('Page', 'default_image')
                )
            )
        );

        /** @var \Image $featuredImage */
        $featuredImage = $page->FeaturedImage();
        if ($featuredImage->exists()) {
            $newsArticle->setImageObject(new ImageObjectSchema(
                $featuredImage->Fill(800, 800)->AbsoluteLink(),
                800,
                800
            ));
        }

        return $newsArticle;
    }
}