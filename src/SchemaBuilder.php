<?php
/**
 * SchemaBuilder.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

namespace Broarm\Schema;

use Psr\SimpleCache\CacheInterface;
use SilverStripe\Core\Flushable;
use SilverStripe\Core\Injector\Injector;
use Spatie\SchemaOrg\Base;
use Spatie\SchemaOrg\BaseType;

/**
 * SchemaBuilder
 */
abstract class SchemaBuilder implements Flushable
{
    /**
     * Get the schema from the given data
     *
     * @param $page
     * @return BaseType|array
     */
    abstract public function getSchema($page);

    public function getSchemaFromCache($page): ?array
    {
        $objectClassName = get_class($page);
        $objectId = $page->ID;
        $schemaClassName = get_class($this);
        $schema = self::get_schema_from_cache($objectClassName, $objectId, $schemaClassName);
        $array = null;
        if($schema === null) {
            $schema = $this->getSchema($page);
            if($schema && is_array($schema) === false) {
                $array = $schema->toArray();
            } elseif($schema) {
                $array = $schema;
            } else {
                $array = null;
            }
            self::set_schema_in_cache($objectClassName, $objectId, $schemaClassName, $array);
        } elseif(is_array($schema)) {
            $array = $schema;
        }
        return $array;
    }


    protected function filterArray(array $array): array
    {
        return array_values(array_filter($array));
    }

    public static function get_schema_from_cache(string $objectClassName, int $objectId, string $schemaClassName): ?array
    {
        $key = self::make_cache_key($objectClassName, $objectId, $schemaClassName);
        /** @var CacheInterface $cache */
        $cache = Injector::inst()->get(CacheInterface::class . '.schema_org');
        if((bool) $cache->has($key) !== false) {
            $return = unserialize((string) $cache->get($key));
            return is_array($return) ? $return : null;
        }
        return null;
    }

    public static function set_schema_in_cache(string $objectClassName, int $objectId, string $schemaClassName, ?array $value)
    {
        $key = self::make_cache_key($objectClassName, $objectId, $schemaClassName);
        /** @var CacheInterface $cache */
        $cache = Injector::inst()->get(CacheInterface::class . '.schema_org');
        $cache->set($key, serialize($value));
    }

    public static function clear_schema_cache()
    {
        $cache = Injector::inst()->get(CacheInterface::class . '.schema_org');

        // remove all items in this (namespaced) cache
        $cache->clear();
    }

    public static function make_cache_key(string $objectClassName, int $objectId, string $schemaClassName): string
    {
        return str_replace('\\', '-', $objectClassName . '_' . $objectId . '_' . $schemaClassName);
    }

    public static function flush()
    {
        self::clear_schema_cache();
    }

}
