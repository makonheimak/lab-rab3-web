<?php

namespace MaksimYurash\EcommerceSuite\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MaksimYurash\EcommerceSuite\Models\Customer;
use MaksimYurash\EcommerceSuite\Models\Order;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'number' => 'ORD-' . now()->format('Ymd') . '-' . $this->faker->unique()->numberBetween(1000, 9999),
            'status' => $this->faker->randomElement(['new', 'paid', 'shipping', 'completed', 'cancelled']),
            'total_amount' => $this->faker->randomFloat(2, 300, 50000),
            'currency' => 'RUB',
            'delivery_from' => $this->faker->address(),
            'delivery_to' => $this->faker->address(),
            'delivery_cost' => $this->faker->randomFloat(2, 100, 2000),
            'placed_at' => $this->faker->dateTimeBetween('-6 months'),
        ];
    }
}
