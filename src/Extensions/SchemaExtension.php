<?php
/**
 * SchemaExtension.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

namespace Broarm\Schema;

use Broarm\Schema\SchemaBuilder;
use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Convert;
use SilverStripe\ORM\DataExtension;
use SilverStripe\View\Requirements;
use Spatie\SchemaOrg\BaseType;

/**
 * SchemaExtension
 */
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
        $schemaBuilders = $this->getOwner()->getSchemasOrg();
        /** @var SchemaBuilder $schemaBuilder */
        foreach($schemaBuilders as $schemaBuilder) {
            $this->appendSchemaOrg($tags, $schemaBuilder);
        }
    }


    /**
     * Append a schema ld+json tag
     *
     * @param $tags
     * @param $schema
     */
    private function appendSchemaOrg(&$tags, $schemaBuilder)
    {
        if ($schemaBuilder) {
            $objectClassName = get_class($this->owner);
            $schemaBuilderClassName = get_class($schemaBuilder);
            $array = SchemaBuilder::get_schema_from_cache(
                $objectClassName,
                $this->owner->ID,
                $schemaBuilderClassName
            );
            if(! $array) {
                $array = $schemaBuilder->getSchema($this->owner);
                SchemaBuilder::set_schema_in_cache(
                    $objectClassName,
                    $this->owner->ID,
                    $schemaBuilderClassName,
                    $array
                );
            }
            Requirements::insertHeadTags(
                '<script type="application/ld+json">' . json_encode($array, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>',
                $schemaBuilderClassName
            );
        }
    }

    /**
     *
     *
     * @return SchemaBuilder[]
     */
    protected function getSchemasOrg()
    {
        $array = [];
        $schemas = array_filter($this->owner->config()->get('active_schema'));
        foreach ($schemas as $schema) {
            if (! (class_exists($schema) && new $schema() instanceof SchemaBuilder)) {
                user_error("Schema {$schema} is not a valid schema", E_USER_WARNING);
            }
            $schemaBuilder = new $schema();
            $array[$schema] = $schemaBuilder;
        }
        return $array;
    }



}
