<?php

namespace MaksimYurash\EcommerceSuite\Facades;

use Illuminate\Support\Facades\Facade;

class CurrencyRate extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'ecommerce.currency';
    }
}
