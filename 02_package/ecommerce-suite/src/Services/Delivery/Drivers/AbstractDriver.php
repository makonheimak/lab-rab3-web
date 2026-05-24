<?php

namespace MaksimYurash\EcommerceSuite\Services\Delivery\Drivers;

abstract class AbstractDriver
{
    protected function priceByDistance(float $distanceKm, float $weightKg, array $priceConfig): float
    {
        return (float) $priceConfig['base']
            + $distanceKm * (float) $priceConfig['per_km']
            + max($weightKg, 0) * (float) $priceConfig['per_kg'];
    }
}
