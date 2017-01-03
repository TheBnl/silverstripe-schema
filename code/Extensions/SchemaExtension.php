<?php
/**
 * SchemaExtension.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

namespace Schema;

use Schema\Builder\SchemaBuilder;
use SilverStripe\CMS\Model\SiteTreeExtension;
use SilverStripe\Core\Convert;

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
            if (Schema::is_valid($schema)) $this->appendSchema($tags, new $schema());
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
        if ($schema = $schema::create()->getSchema($this->owner)) {
            $tags .= sprintf(
                "<script type='application/ld+json'>%s</script>",
                Convert::array2json($schema)
            );
        }
    }

}