<?php
/**
 * SchemaExtension.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

namespace Broarm\Schema;

use Broarm\Schema\Builder\SchemaBuilder;


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
        $schemas = Config::inst()->get($this->owner->getClassName(), 'active_schema');
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
            $tags .= sprintf(
                "<script type='application/ld+json'>%s</script>",
                Convert::array2json($schema)
            );
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