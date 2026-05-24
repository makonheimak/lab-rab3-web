<?php

namespace MaksimYurash\EcommerceSuite\Http\Controllers\Crud;

use MaksimYurash\EcommerceSuite\Models\Customer;

class CustomerController extends BaseCrudController
{
    protected string $modelClass = Customer::class;
    protected string $title = 'Клиенты';
    protected string $routeKey = 'customers';
    protected array $fields = ['full_name', 'email', 'phone', 'address'];
    protected array $fieldLabels = ['full_name' => 'ФИО', 'email' => 'Email', 'phone' => 'Телефон', 'address' => 'Адрес'];
    protected array $rules = ['full_name' => ['required','string','max:255'], 'email' => ['required','email'], 'phone' => ['nullable','string'], 'address' => ['nullable','string']];
}
