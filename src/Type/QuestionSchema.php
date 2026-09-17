<?php

namespace Broarm\Schema\Type;

/**
 * schema.org/Question with a single acceptedAnswer. Nested in an FAQPage — no @context of its own.
 *
 * @package Broarm\Schema\Type
 */
class QuestionSchema extends SchemaType
{
    public string $type = 'Question';

    public string $name;
    public AnswerSchema $acceptedAnswer;

    public function __construct(string $name, AnswerSchema $acceptedAnswer)
    {
        $this->name = $name;
        $this->acceptedAnswer = $acceptedAnswer;
    }
}
