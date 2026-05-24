<?php

namespace MaksimYurash\EcommerceSuite\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use MaksimYurash\EcommerceSuite\Models\Category;
use MaksimYurash\EcommerceSuite\Models\Product;
use MaksimYurash\EcommerceSuite\Tests\TestCase;

class ProductCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_can_be_created_by_model(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'name' => 'Unit Test Product',
            'sku' => 'UNIT-001',
        ]);

        $this->assertDatabaseHas(config('ecommerce-suite.table_prefix', 'mshop_') . 'products', [
            'id' => $product->id,
            'sku' => 'UNIT-001',
        ]);
    }
}
