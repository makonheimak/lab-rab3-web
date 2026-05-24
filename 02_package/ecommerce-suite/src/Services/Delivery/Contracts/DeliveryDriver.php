<?php

namespace MaksimYurash\EcommerceSuite\Services\Delivery\Contracts;

use MaksimYurash\EcommerceSuite\Services\Delivery\DeliveryResult;

interface DeliveryDriver
{
    public function calculate(array|string $from, array|string $to, float $weightKg = 1.0): DeliveryResult;
}
