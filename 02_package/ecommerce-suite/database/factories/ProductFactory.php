<?php

namespace MaksimYurash\EcommerceSuite\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MaksimYurash\EcommerceSuite\Models\Category;
use MaksimYurash\EcommerceSuite\Models\Product;
use MaksimYurash\EcommerceSuite\Models\Supplier;
use MaksimYurash\EcommerceSuite\Models\Warehouse;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'supplier_id' => Supplier::factory(),
            'warehouse_id' => Warehouse::factory(),
            'name' => ucfirst($this->faker->words(3, true)),
            'sku' => strtoupper($this->faker->unique()->bothify('SKU-####-??')),
            'description' => $this->faker->paragraph(2),
            'price' => $this->faker->randomFloat(2, 100, 100000),
            'currency' => 'RUB',
            'weight' => $this->faker->randomFloat(3, 0.1, 25),
            'cover_path' => 'covers/products/default.png',
            'quantity' => $this->faker->numberBetween(0, 1000),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
        ];
    }
}
