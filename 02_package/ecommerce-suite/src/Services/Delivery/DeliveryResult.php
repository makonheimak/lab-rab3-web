<?php

namespace MaksimYurash\EcommerceSuite\Services\Delivery;

class DeliveryResult
{
    public function __construct(
        public readonly string $driver,
        public readonly float $distanceKm,
        public readonly float $price,
        public readonly array $meta = [],
    ) {}

    public function toArray(): array
    {
        return [
            'driver' => $this->driver,
            'distance_km' => round($this->distanceKm, 3),
            'price' => round($this->price, 2),
            'meta' => $this->meta,
        ];
    }
}
