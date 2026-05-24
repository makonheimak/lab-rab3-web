<?php

namespace MaksimYurash\EcommerceSuite\Http\Controllers\Crud;

use MaksimYurash\EcommerceSuite\Models\Warehouse;

class WarehouseController extends BaseCrudController
{
    protected string $modelClass = Warehouse::class;
    protected string $title = 'Склады';
    protected string $routeKey = 'warehouses';
    protected array $fields = ['title', 'address', 'latitude', 'longitude', 'capacity', 'is_active'];
    protected array $fieldLabels = ['title' => 'Название', 'address' => 'Адрес', 'latitude' => 'Широта', 'longitude' => 'Долгота', 'capacity' => 'Вместимость', 'is_active' => 'Активен'];
    protected array $rules = ['title' => ['required','string','max:255'], 'address' => ['required','string'], 'latitude' => ['nullable','numeric'], 'longitude' => ['nullable','numeric'], 'capacity' => ['nullable','integer','min:0'], 'is_active' => ['nullable','boolean']];
}
