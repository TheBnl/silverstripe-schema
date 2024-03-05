<?php

namespace Broarm\Schema\Type;

class NewsArticleSchema extends SchemaType
{
    public string $context = 'http://schema.org';
    public string $type = 'NewsArticle';
    public string $headline;
    public string $datePublished;
    public string $dateModified;
    public string $description;
    public EntityOfPageSchema $mainEntityOfPage;
    public ImageObjectSchema $image;
    public PersonSchema $author;
    public OrganizationSchema $publisher;

    public function __construct(string $headline, string $datePublished, string $dateModified, string $description) {
        $this->headline = $headline;
        $this->datePublished = $datePublished;
        $this->dateModified = $dateModified;
        $this->description = $description;
    }

    public function setImageObject(ImageObjectSchema $image) {
        $this->image = $image;
    }

    public function setAuthor(PersonSchema $author) {
        $this->author = $author;
    }

    public function setMainEntityOfPage(EntityOfPageSchema $mainEntityOfPage) {
        $this->mainEntityOfPage = $mainEntityOfPage;
    }

    public function setPublisher(OrganizationSchema $publisher) {
        $this->publisher = $publisher;
    }
}
