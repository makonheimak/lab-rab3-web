<?php

namespace MaksimYurash\EcommerceSuite\Http\Controllers\Crud;

use MaksimYurash\EcommerceSuite\Models\Order;

class OrderController extends BaseCrudController
{
    protected string $modelClass = Order::class;
    protected string $title = 'Заказы';
    protected string $routeKey = 'orders';
    protected array $fields = ['customer_id', 'number', 'status', 'total_amount', 'currency', 'delivery_from', 'delivery_to', 'delivery_cost'];
    protected array $fieldLabels = ['customer_id' => 'Клиент', 'number' => 'Номер заказа', 'status' => 'Статус', 'total_amount' => 'Сумма', 'currency' => 'Валюта', 'delivery_from' => 'Адрес отправления', 'delivery_to' => 'Адрес доставки', 'delivery_cost' => 'Стоимость доставки'];
    protected array $rules = ['customer_id' => ['required','integer'], 'number' => ['required','string','max:100'], 'status' => ['required','string'], 'total_amount' => ['nullable','numeric'], 'currency' => ['required','string','size:3'], 'delivery_from' => ['nullable','string'], 'delivery_to' => ['nullable','string'], 'delivery_cost' => ['nullable','numeric']];
}
