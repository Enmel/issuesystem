<?php
namespace Modules\Portfolio\PortfolioItem;

class Size
{
    const XS = "TOY";
    const S = "PEQUEÑO";
    const M = "MEDIANO";
    const L = "GRANDE";
    const XL = "MUY GRANDE";

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