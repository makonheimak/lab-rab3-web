<?php

use Illuminate\Support\Facades\Route;
use MaksimYurash\EcommerceSuite\Http\Controllers\Api\CategoryApiController;
use MaksimYurash\EcommerceSuite\Http\Controllers\Api\CustomerApiController;
use MaksimYurash\EcommerceSuite\Http\Controllers\Api\OrderApiController;
use MaksimYurash\EcommerceSuite\Http\Controllers\Api\ProductApiController;
use MaksimYurash\EcommerceSuite\Http\Controllers\Api\SupplierApiController;
use MaksimYurash\EcommerceSuite\Http\Controllers\Api\UtilityApiController;
use MaksimYurash\EcommerceSuite\Http\Controllers\Api\WarehouseApiController;

Route::middleware(config('ecommerce-suite.api_middleware', ['api', 'ecommerce.api.version']))
    ->prefix(config('ecommerce-suite.api_prefix', 'shop-api'))
    ->as('ecommerce-suite.api.')
    ->group(function () {
        Route::apiResource('categories', CategoryApiController::class);
        Route::apiResource('products', ProductApiController::class);
        Route::apiResource('suppliers', SupplierApiController::class);
        Route::apiResource('customers', CustomerApiController::class);
        Route::apiResource('warehouses', WarehouseApiController::class);
        Route::apiResource('orders', OrderApiController::class);

        Route::get('currency/{code?}', [UtilityApiController::class, 'currency'])->name('currency');
        Route::post('delivery/calculate', [UtilityApiController::class, 'delivery'])
            ->middleware('ecommerce.api.version:2')
            ->name('delivery.calculate');
    });
