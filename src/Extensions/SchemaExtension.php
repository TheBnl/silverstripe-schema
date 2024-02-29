<?php
/**
 * SchemaExtension.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

namespace Broarm\Schema;

use Broarm\Schema\SchemaBuilder;
use SilverStripe\Control\Controller;
use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Convert;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\FieldType\DBVarchar;
use SilverStripe\View\Requirements;
use Spatie\SchemaOrg\BaseType;

/**
 * SchemaExtension
 */
class SchemaExtension extends DataExtension
{
    private static $exempted_get_vars = [
        'start',
        'flush',
    ];

    /**
     * Hook onto the page meta tags and append any configured schema objects
     * fixme: does not trigger correctly on DataObjects pages
     *
     * @param $tags
     */
    public function MetaTags(&$tags)
    {
        $curr = Controller::curr();
        if($curr) {
            $request = Controller::curr()->getRequest();
            if($request) {
                if($request->isAjax()) {
                    return;
                }
                if($request->param('Action')) {
                    return;
                }
                $postVars = $request->postVars();
                if(! empty($postVars)) {
                    return;
                }
                $getVars = $request->getVars();
                if(! empty($getVars)) {
                    if(count($_GET) > 1) {
                        return;
                    } else {
                        if(!empty(array_intersect(array_keys($getVars), Config::inst()->get(static::class, 'exempted_get_vars')))) {
                            return;
                        }
                    }
                }
                $schemaBuilders = $this->getSchemasOrg();
                /** @var SchemaBuilder $schemaBuilder */
                foreach($schemaBuilders as $schemaBuilder) {
                    $this->appendSchemaOrg($tags, $schemaBuilder);
                }
            }
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
            $owner = $this->getOwner();
            $array = $schemaBuilder->getSchemaFromCache($owner);
            if(!empty($array)) {
                $string = str_replace('$', '&#36;', json_encode($array, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
                Requirements::insertHeadTags(
                    '<script type="application/ld+json">' . $string . '</script>',
                    get_class($schemaBuilder)
                );
            }
        }
    }

    /**
     *
     *
     * @return SchemaBuilder[]
     */
    public function getSchemasOrg()
    {
        $array = [];
        $schemas = array_filter($this->owner->config()->get('active_schema'));
        foreach ($schemas as $schema) {
            if(class_exists($schema)) {
                $schemaBuilder = new $schema();
                if ($schemaBuilder instanceof SchemaBuilder) {
                    $array[$schema] = $schemaBuilder;
                }
            }
        }
        return $array;
    }

    public function onAfterWrite()
    {
        SchemaBuilder::clear_schema_cache();
    }


}
