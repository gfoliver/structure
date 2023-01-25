<?php

namespace Gfoliver\Structure\Utils;

class Enum
{
    static $labels = [];

    static function getKeys()
    {
        $class = new \ReflectionClass(get_called_class());
        return array_keys($class->getConstants());
    }

    public static function getConstants()
    {
        $reflectionClass = new \ReflectionClass(static::class);
        return $reflectionClass->getConstants();
    }

    public static function label(string $type)
    {
        if ( isset( static::$labels[$type] ) )
            return static::$labels[$type];

        return $type;
    }

    public static function values() {
        return array_values(static::getConstants());
    }

    public static function format() {
        return array_map(function($item) {
            return [
                'value' => $item,
                'label' => static::label($item)
            ];
        }, static::values());
    }
}
