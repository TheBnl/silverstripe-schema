<?php

namespace Broarm\Schema\Type;

use JsonSerializable;
use SilverStripe\Core\Config\Configurable;
use SilverStripe\Core\Injector\Injectable;

abstract class SchemaType implements JsonSerializable
{
    use Configurable;
    use Injectable;

    private static $at_keys = [
        'type',
        'context',
        'id',
    ];

    public string $type;

    public function jsonSerialize(): mixed
    {
        $data = (array) $this;
        return $this->convertAtKeys($data);
    }

    public function convertAtKeys(array $data) : array
    {
        $atKeys = self::config()->get('at_keys') ?? [];
        foreach ($data as $key => $value) {
            if (in_array($key, $atKeys)) {
                unset($data[$key]);
                $data["@{$key}"] = $this->{$key};
            }

            if ($value instanceof SchemaType) {
                $value = (array) $value;
                $data[$key] = $this->convertAtKeys($value);
            }
        }

        return $data;
    }
}
