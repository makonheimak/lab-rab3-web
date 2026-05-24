<?php

namespace MaksimYurash\EcommerceSuite\Http\Controllers\Crud;

use MaksimYurash\EcommerceSuite\Models\Supplier;

class SupplierController extends BaseCrudController
{
    protected string $modelClass = Supplier::class;
    protected string $title = 'Поставщики';
    protected string $routeKey = 'suppliers';
    protected array $fields = ['name', 'contact_person', 'email', 'phone', 'address', 'is_active'];
    protected array $fieldLabels = ['name' => 'Название', 'contact_person' => 'Контактное лицо', 'email' => 'Email', 'phone' => 'Телефон', 'address' => 'Адрес', 'is_active' => 'Активен'];
    protected array $rules = ['name' => ['required','string','max:255'], 'contact_person' => ['nullable','string'], 'email' => ['nullable','email'], 'phone' => ['nullable','string'], 'address' => ['nullable','string'], 'is_active' => ['nullable','boolean']];
}
