<?php

namespace MaksimYurash\EcommerceSuite\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use MaksimYurash\EcommerceSuite\Models\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = ucfirst($this->faker->unique()->words(2, true));
        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(10, 9999),
            'description' => $this->faker->sentence(10),
            'cover_path' => 'covers/categories/default.png',
            'is_active' => true,
        ];
    }
}
