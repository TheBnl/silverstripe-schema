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
            $page->dbObject('Content')->FirstParagraph()
        );

        $newsArticle->setMainEntityOfPage(new EntityOfPageSchema($page->AbsoluteLink()));
        $newsArticle->setAuthor(new PersonSchema($author));
        $newsArticle->setPublisher(new OrganizationSchema(
            SiteConfig::current_site_config()->Title,
            Director::absoluteBaseURL(),
            new ImageObjectSchema(
                Director::absoluteBaseURL() . Config::inst()->get('Page', 'default_image')
            )
        ));

        /** @var \Image $featuredImage */
        $featuredImage = $page->FeaturedImage();
        if ($featuredImage->exists()) {
            $image = new ImageObjectSchema($featuredImage->Fill(800, 800)->AbsoluteLink());
            $image->setWidth(800);
            $image->setWidth(800);
            $newsArticle->setImageObject($image);
        }

        return $newsArticle;
    }
}
