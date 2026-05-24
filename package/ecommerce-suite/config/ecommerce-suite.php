<?php

return [
    'table_prefix' => env('ECOMMERCE_TABLE_PREFIX', 'mshop_'),

    'web_prefix' => env('ECOMMERCE_WEB_PREFIX', 'shop-panel'),
    'api_prefix' => env('ECOMMERCE_API_PREFIX', 'shop-api'),

    'web_middleware' => ['web'],
    'api_middleware' => ['api', 'ecommerce.api.version'],

    'default_api_version' => (int) env('ECOMMERCE_API_VERSION', 1),

    'pagination' => [
        'per_page' => (int) env('ECOMMERCE_PER_PAGE', 10),
        'max_per_page' => (int) env('ECOMMERCE_MAX_PER_PAGE', 100),
    ],

    'currency' => [
        'base' => env('ECOMMERCE_CURRENCY_BASE', 'RUB'),
        'cache_ttl' => (int) env('ECOMMERCE_CURRENCY_CACHE_TTL', 3600),
        'cbr_url' => env('ECOMMERCE_CBR_URL', 'https://www.cbr.ru/scripts/XML_daily.asp'),
    ],

    'delivery' => [
        'driver' => env('ECOMMERCE_DELIVERY_DRIVER', 'math'),
        'price' => [
            'base' => (float) env('ECOMMERCE_DELIVERY_BASE_PRICE', 150),
            'per_km' => (float) env('ECOMMERCE_DELIVERY_PRICE_PER_KM', 18),
            'per_kg' => (float) env('ECOMMERCE_DELIVERY_PRICE_PER_KG', 35),
        ],
        'drivers' => [
            'math' => [
                'name' => 'Mathematical Haversine distance',
            ],
            'google' => [
                'name' => 'Google Distance Matrix API',
                'key' => env('GOOGLE_DISTANCE_MATRIX_KEY'),
                'endpoint' => 'https://maps.googleapis.com/maps/api/distancematrix/json',
            ],
            'yandex' => [
                'name' => 'Yandex Maps Distance Matrix API',
                'key' => env('YANDEX_MAPS_KEY'),
                'endpoint' => 'https://api.routing.yandex.net/v2/distancematrix',
            ],
        ],
    ],
];
