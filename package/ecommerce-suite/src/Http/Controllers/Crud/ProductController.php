<?php

namespace MaksimYurash\EcommerceSuite\Http\Controllers\Crud;

use MaksimYurash\EcommerceSuite\Models\Product;

class ProductController extends BaseCrudController
{
    protected string $modelClass = Product::class;
    protected string $title = 'Товары';
    protected string $routeKey = 'products';
    protected array $fields = ['category_id', 'supplier_id', 'warehouse_id', 'name', 'sku', 'price', 'currency', 'quantity', 'status'];
    protected array $fieldLabels = ['category_id' => 'Категория', 'supplier_id' => 'Поставщик', 'warehouse_id' => 'Склад', 'name' => 'Название', 'sku' => 'Артикул', 'price' => 'Цена', 'currency' => 'Валюта', 'quantity' => 'Количество', 'status' => 'Статус'];
    protected array $rules = ['category_id' => ['required','integer'], 'supplier_id' => ['nullable','integer'], 'warehouse_id' => ['nullable','integer'], 'name' => ['required','string','max:255'], 'sku' => ['required','string','max:100'], 'price' => ['required','numeric','min:0'], 'currency' => ['required','string','size:3'], 'quantity' => ['nullable','integer','min:0'], 'status' => ['required','string']];
}
