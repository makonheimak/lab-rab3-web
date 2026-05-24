<?php

namespace MaksimYurash\EcommerceSuite\Facades;

use Illuminate\Support\Facades\Facade;

class DeliveryCost extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'ecommerce.delivery';
    }
}
