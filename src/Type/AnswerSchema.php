<?php

namespace Broarm\Schema\Type;

/**
 * schema.org/Answer — the accepted answer of a Question. Nested — no @context of its own.
 *
 * @package Broarm\Schema\Type
 */
class AnswerSchema extends SchemaType
{
    public string $type = 'Answer';

    public string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }
}
