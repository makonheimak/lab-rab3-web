<?php

namespace MaksimYurash\EcommerceSuite\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MaksimYurash\EcommerceSuite\Models\Warehouse;

class WarehouseFactory extends Factory
{
    protected $model = Warehouse::class;

    public function definition(): array
    {
        return [
            'title' => 'Warehouse ' . strtoupper($this->faker->bothify('??-###')),
            'address' => $this->faker->address(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'capacity' => $this->faker->numberBetween(100, 5000),
            'is_active' => true,
        ];
    }
}
