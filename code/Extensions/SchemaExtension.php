<?php
/**
 * SchemaExtension.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */


/**
 * SchemaExtension
 */
class SchemaExtension extends SiteTreeExtension
{

    /**
     * Hook onto the page meta tags and append any configured schema objects
     *
     * @param $tags
     */
    public function MetaTags(&$tags)
    {
        $schemas = Schema::get_schema_config($this->owner->getClassname());
        foreach ($schemas as $schema) {
            if (self::schema_is_valid($schema)) $this->appendSchema($tags, new $schema());
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
        $tags .= sprintf(
            "<script type='application/ld+json'>%s</script>",
            json_encode($schema::get_schema($this->owner))
        );
    }


    /**
     * Check
     *
     * @param $schema
     * @return bool
     */
    private static function schema_is_valid($schema)
    {
        return class_exists($schema) && new $schema() instanceof SchemaBuilder;
    }

}