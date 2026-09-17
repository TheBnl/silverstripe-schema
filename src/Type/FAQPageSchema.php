<?php

namespace Broarm\Schema\Type;

/**
 * schema.org/FAQPage — a set of Question/Answer pairs. Populate from a project-level builder.
 *
 * @package Broarm\Schema\Type
 */
class FAQPageSchema extends SchemaType
{
    public string $context = 'https://schema.org';
    public string $type = 'FAQPage';

    /** @var QuestionSchema[] */
    public array $mainEntity = [];

    public function __construct(array $mainEntity = [])
    {
        $this->mainEntity = $mainEntity;
    }

    public function addQuestion(QuestionSchema $question): static
    {
        $this->mainEntity[] = $question;
        return $this;
    }
}
