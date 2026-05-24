<?php

namespace MaksimYurash\EcommerceSuite\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MaksimYurash\EcommerceSuite\Models\Order;
use MaksimYurash\EcommerceSuite\Models\OrderItem;
use MaksimYurash\EcommerceSuite\Models\Product;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        $price = $this->faker->randomFloat(2, 100, 10000);
        $quantity = $this->faker->numberBetween(1, 5);
        return [
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
            'product_name' => ucfirst($this->faker->words(3, true)),
            'unit_price' => $price,
            'quantity' => $quantity,
            'line_total' => $price * $quantity,
        ];
    }
}
