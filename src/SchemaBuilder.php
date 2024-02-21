<?php
/**
 * SchemaBuilder.php
 *
 * @author Bram de Leeuw
 * Date: 03/11/16
 */

namespace Broarm\Schema;

use Psr\SimpleCache\CacheInterface;
use SilverStripe\Core\Injector\Injector;
use Spatie\SchemaOrg\Base;
use Spatie\SchemaOrg\BaseType;

/**
 * SchemaBuilder
 */
abstract class SchemaBuilder
{
    /**
     * Get the schema from the given data
     *
     * @param $page
     * @return BaseType|array
     */
    abstract public function getSchema($page);

    public static function get_schema_from_cache(string $objectClassName, int $objectId, string $schemaClassName): ?array
    {
        $key = $objectClassName . '_' . $objectId . '_' . $schemaClassName;
        /** @var CacheInterface $cache */
        $cache = Injector::inst()->get(CacheInterface::class . '.schema_org');
        if($cache->has($key) === false) {
            return null;
        }
        return unserialize((string) $cache->get($key));
    }

    public static function set_schema_in_cache(string $objectClassName, int $objectId, string $schemaClassName, ?array $value)
    {
        $key = $objectClassName . '_' . $objectId . '_' . $schemaClassName;
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

}
