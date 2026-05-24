<?php

use Illuminate\Support\Facades\Route;
use MaksimYurash\EcommerceSuite\Facades\CurrencyRate;
use MaksimYurash\EcommerceSuite\Facades\DeliveryCost;

Route::get('/', fn () => view('welcome'));

Route::get('/demo/package/currency/{code?}', function (?string $code = 'USD') {
    return ['currency' => strtoupper($code), 'rate' => CurrencyRate::get($code)];
});

Route::get('/demo/package/delivery', function () {
    return DeliveryCost::calculate(
        ['lat' => 55.7558, 'lng' => 37.6173],
        ['lat' => 59.9343, 'lng' => 30.3351],
        1.5,
        'math'
    );
});
