<?php
namespace Modules\Portfolio\PortfolioItem;

class Type
{
    const DOG = "DOG";
    const CAT = "CAT";
    
    final private function __construct()
    {
    }

    final public static function toArray()
    {
        return (new \ReflectionClass(static::class))->getConstants();
    }

    final public static function isValid($value)
    {
        return in_array($value, static::toArray());
    }
}