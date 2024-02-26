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

    public function __construct(
        $headline,
        $datePublished,
        $dateModified,
        $description,
        EntityOfPageSchema $mainEntityOfPage = null,
        PersonSchema $author = null,
        OrganizationSchema $publisher = null,
        ImageObjectSchema $image = null
    ) {
        $this->headline = $headline;
        $this->datePublished = $datePublished;
        $this->dateModified = $dateModified;
        $this->description = $description;
        $this->mainEntityOfPage = $mainEntityOfPage;
        $this->image = $image;
        $this->author = $author;
        $this->publisher = $publisher;
    }

    public function setImageObject(ImageObjectSchema $image) {
        $this->image = $image;
    }

    public function setPerson(PersonSchema $author) {
        $this->author = $author;
    }

    public function setEntityOfPage(EntityOfPageSchema $mainEntityOfPage) {
        $this->mainEntityOfPage = $mainEntityOfPage;
    }

    public function setPublisher(OrganizationSchema $publisher) {
        $this->publisher = $publisher;
    }
}
