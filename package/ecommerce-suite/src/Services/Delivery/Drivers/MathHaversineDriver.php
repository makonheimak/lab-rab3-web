<?php

namespace MaksimYurash\EcommerceSuite\Services\Delivery\Drivers;

use InvalidArgumentException;
use MaksimYurash\EcommerceSuite\Services\Delivery\Contracts\DeliveryDriver;
use MaksimYurash\EcommerceSuite\Services\Delivery\DeliveryResult;

class MathHaversineDriver extends AbstractDriver implements DeliveryDriver
{
    public function __construct(private readonly array $priceConfig) {}

    public function calculate(array|string $from, array|string $to, float $weightKg = 1.0): DeliveryResult
    {
        if (!is_array($from) || !is_array($to)) {
            throw new InvalidArgumentException('Math delivery driver expects coordinates: [lat => ..., lng => ...].');
        }

        $distance = $this->distanceKm((float) $from['lat'], (float) $from['lng'], (float) $to['lat'], (float) $to['lng']);
        $price = $this->priceByDistance($distance, $weightKg, $this->priceConfig);

        return new DeliveryResult('math', $distance, $price, ['method' => 'haversine']);
    }

    private function distanceKm(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) ** 2
            + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
