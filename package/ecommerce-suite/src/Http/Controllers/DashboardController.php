<?php

namespace MaksimYurash\EcommerceSuite\Http\Controllers;

use Illuminate\Routing\Controller;
use MaksimYurash\EcommerceSuite\Models\Category;
use MaksimYurash\EcommerceSuite\Models\Customer;
use MaksimYurash\EcommerceSuite\Models\Order;
use MaksimYurash\EcommerceSuite\Models\Product;
use MaksimYurash\EcommerceSuite\Models\Supplier;
use MaksimYurash\EcommerceSuite\Models\Warehouse;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('ecommerce-suite::dashboard', [
            'counts' => [
                'Товары' => Product::query()->count(),
                'Категории' => Category::query()->count(),
                'Поставщики' => Supplier::query()->count(),
                'Клиенты' => Customer::query()->count(),
                'Склады' => Warehouse::query()->count(),
                'Заказы' => Order::query()->count(),
            ],
        ]);
    }
}
