<?php

namespace Broarm\Schema\Type;

use JsonSerializable;
use SilverStripe\Core\Config\Configurable;
use SilverStripe\Core\Injector\Injectable;

/**
 * Base schema.org type with a correct JSON-LD serializer.
 *
 * Every object serializes ITSELF: its own @type/@context/@id are emitted, nested
 * schema objects are recursed into (so a PostalAddress inside a LocalBusiness keeps
 * @type "PostalAddress" — not the parent's type), and null/empty values are omitted
 * instead of being rendered as "". Scalars pass through untouched, so an int
 * `position` stays an int.
 *
 * @package Broarm\Schema\Type
 */
abstract class SchemaType implements JsonSerializable
{
    use Configurable;
    use Injectable;

    /**
     * Keys that are emitted with an @ prefix (@type, @context, @id) when set on the object.
     * @config
     */
    private static $at_keys = [
        'type',
        'context',
        'id',
    ];

    public string $type;

    public function jsonSerialize(): mixed
    {
        $atKeys = self::config()->get('at_keys') ?? ['type', 'context', 'id'];

        $data = [];
        // @-prefixed keys first, only when actually set on THIS object.
        foreach ($atKeys as $key) {
            if (property_exists($this, $key) && isset($this->{$key}) && $this->{$key} !== '') {
                $data["@{$key}"] = $this->{$key};
            }
        }
        // Remaining own properties (skipping the @-keys); nested objects serialize themselves.
        foreach (get_object_vars($this) as $key => $value) {
            if (in_array($key, $atKeys, true)) {
                continue;
            }
            $data[$key] = $value;
        }

        return $this->clean($data);
    }

    /**
     * Resolve nested schema objects and strip empty values.
     */
    protected function clean(array $data): array
    {
        $result = [];
        foreach ($data as $key => $value) {
            $value = $this->normalise($value);
            if ($value === null || $value === '' || $value === []) {
                continue;
            }
            $result[$key] = $value;
        }

        return $result;
    }

    /**
     * Recursively normalise a value: nested schema objects (or any JsonSerializable) serialize
     * themselves, arrays are walked (and re-indexed), scalars pass through untouched.
     */
    protected function normalise($value)
    {
        if ($value instanceof JsonSerializable) {
            return $value->jsonSerialize();
        }

        if (is_array($value)) {
            $list = [];
            foreach ($value as $item) {
                $item = $this->normalise($item);
                if ($item === null || $item === '' || $item === []) {
                    continue;
                }
                $list[] = $item;
            }
            return $list;
        }

        return $value;
    }
}
