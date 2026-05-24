<?php

namespace MaksimYurash\EcommerceSuite\Tests\Unit;

use MaksimYurash\EcommerceSuite\Facades\DeliveryCost;
use MaksimYurash\EcommerceSuite\Tests\TestCase;

class DeliveryMathDriverTest extends TestCase
{
    public function test_it_calculates_delivery_by_haversine_method(): void
    {
        $result = DeliveryCost::calculate(
            ['lat' => 55.7558, 'lng' => 37.6173],
            ['lat' => 59.9343, 'lng' => 30.3351],
            2,
            'math'
        );

        $this->assertSame('math', $result['driver']);
        $this->assertGreaterThan(500, $result['distance_km']);
        $this->assertGreaterThan(0, $result['price']);
    }
}
