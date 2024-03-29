<?php

namespace Broarm\Schema;

use Broarm\Schema\Builder\SchemaBuilder;
use SilverStripe\ORM\DataExtension;
use SilverStripe\View\Requirements;

class SchemaExtension extends DataExtension
{
    /**
     * Hook onto the page meta tags and append any configured schema objects
     * fixme: does not trigger correctly on DataObjects pages
     *
     * @param $tags
     */
    public function MetaTags(&$tags)
    {
        $schemas = array_filter($this->owner->config()->get('active_schema'));
        foreach ($schemas as $schema) {
            if (self::is_valid($schema)) $this->appendSchema($tags, new $schema());
        }
    }

    /**
     * Append a schema ld+json tag
     *
     * @param $tags
     * @param $schema
     */
    private function appendSchema(&$tags, SchemaBuilder $schema)
    {
        if ($schema = $schema->getSchema($this->owner)) {
            Requirements::insertHeadTags(sprintf(
                "<script type='application/ld+json'>%s</script>",
                json_encode($schema)
            ), get_class($schema));
        }
    }

    /**
     * Check if the set schema is of an active and available type
     *
     * @param $schema
     *
     * @return bool
     */
    private static function is_valid($schema)
    {
        return class_exists($schema) && new $schema() instanceof SchemaBuilder;
    }
}
