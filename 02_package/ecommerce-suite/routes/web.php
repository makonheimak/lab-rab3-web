<?php

use Illuminate\Support\Facades\Route;
use MaksimYurash\EcommerceSuite\Http\Controllers\Crud\CategoryController;
use MaksimYurash\EcommerceSuite\Http\Controllers\Crud\CustomerController;
use MaksimYurash\EcommerceSuite\Http\Controllers\Crud\OrderController;
use MaksimYurash\EcommerceSuite\Http\Controllers\Crud\ProductController;
use MaksimYurash\EcommerceSuite\Http\Controllers\Crud\SupplierController;
use MaksimYurash\EcommerceSuite\Http\Controllers\Crud\WarehouseController;
use MaksimYurash\EcommerceSuite\Http\Controllers\DashboardController;

Route::middleware(config('ecommerce-suite.web_middleware', ['web']))
    ->prefix(config('ecommerce-suite.web_prefix', 'shop-panel'))
    ->as('ecommerce-suite.')
    ->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('suppliers', SupplierController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('warehouses', WarehouseController::class);
        Route::resource('orders', OrderController::class);
    });
