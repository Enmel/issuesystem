<?php
namespace Modules\Portfolio\PortfolioItem;

class Age
{
    const CACHORRO = "CACHORRO";
    const ADULTO = "ADULTO";
    const SENIOR = "SENIOR";
    
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