<?php

namespace Broarm\Schema\Type;

/**
 * schema.org/Event
 *
 * Generic event type. A site populates it from its own event model in a project-level builder;
 * the module ships only the type. `performer` accepts any schema object (Person/Organization, or a
 * music-specific type on sites that have one).
 *
 * @package Broarm\Schema\Type
 */
class EventSchema extends SchemaType
{
    public string $context = 'https://schema.org';
    public string $type = 'Event';

    public ?string $name = null;
    public ?string $url = null;
    public ?string $startDate = null;
    public ?string $endDate = null;
    public ?string $eventStatus = 'https://schema.org/EventScheduled';
    public ?string $eventAttendanceMode = 'https://schema.org/OfflineEventAttendanceMode';
    public ?string $description = null;

    /** @var string[] */
    public array $image = [];

    public ?PlaceSchema $location = null;

    /** @var OfferSchema[] */
    public array $offers = [];

    /** @var SchemaType[] performing acts (PersonSchema/OrganizationSchema) */
    public array $performer = [];

    public ?OrganizationSchema $organizer = null;

    public function __construct(?string $name = null)
    {
        $this->name = $name ?: null;
    }
}
