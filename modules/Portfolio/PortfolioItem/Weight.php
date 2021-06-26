<?php
namespace Modules\Portfolio\PortfolioItem;

class Weight
{
    const MUY_DELGADO = "MUY DELGADO";
    const IDEAL = "IDEAL";
    const MUY_PESADO = "MUY PESADO";
    
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