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
        $schemas = $this->getOwner()->getSchemas();
        /** @var BaseType $schemaObject */
        foreach($schemas as $schemaObject) {
            $this->appendSchema($tags, $schemaObject);
        }
    }


    /**
     * Append a schema ld+json tag
     *
     * @param $tags
     * @param $schema
     */
    private function appendSchema(&$tags, BaseType $schemaObject)
    {
        if ($schemaObject) {
            Requirements::insertHeadTags(
                '<script type="application/ld+json">' . json_encode($schemaObject->toArray(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>',
                get_class($schemaObject)
            );
        }
    }

    /**
     *
     *
     * @return BaseType[]
     */
    public function getSchemas()
    {
        $array = [];
        $schemas = array_filter($this->owner->config()->get('active_schema'));
        foreach ($schemas as $schema) {
            if (! (class_exists($schema) && new $schema() instanceof SchemaBuilder)) {
                user_error("Schema {$schema} is not a valid schema", E_USER_WARNING);
            }
            $schemaBuilder = new $schema();
            $array[$schema] = $schemaBuilder->getSchema($this->owner);
        }
        return $array;
    }

}
