<?php
namespace Modules\Portfolio\PortfolioItem;

class Needs
{
    const PIEL_SENSIBLE = "PIEL SENSIBLE";
    const ESTOMAGO_DELICADO = "ESTOMAGO DELICADO/SENSIBLE";
    const EXIGENTE_CON_LA_COMIDA = "EXIGENTE CON LA COMIDA";
    const ATLETICO = "ATLETICO/DEPORTISTA";
    const SOBREPESO = "SOBREPESO";
    const SIN_NECESIDAD_ESPECIFICA = "SIN NECESIDAD ESPECIFICA";
    
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