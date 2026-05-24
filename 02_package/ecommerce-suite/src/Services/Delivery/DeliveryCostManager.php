<?php

namespace MaksimYurash\EcommerceSuite\Services\Delivery;

use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Http\Client\Factory as HttpFactory;
use InvalidArgumentException;
use MaksimYurash\EcommerceSuite\Services\Delivery\Contracts\DeliveryDriver;
use MaksimYurash\EcommerceSuite\Services\Delivery\Drivers\GoogleDistanceMatrixDriver;
use MaksimYurash\EcommerceSuite\Services\Delivery\Drivers\MathHaversineDriver;
use MaksimYurash\EcommerceSuite\Services\Delivery\Drivers\YandexMapsDriver;

class DeliveryCostManager
{
    public function __construct(
        private readonly ConfigRepository $config,
        private readonly HttpFactory $http,
    ) {}

    public function calculate(array|string $from, array|string $to, float $weightKg = 1.0, ?string $driver = null): array
    {
        $driver = $driver ?: $this->config->get('ecommerce-suite.delivery.driver', 'math');

        return $this->driver($driver)->calculate($from, $to, $weightKg)->toArray();
    }

    public function driver(string $driver): DeliveryDriver
    {
        $price = $this->config->get('ecommerce-suite.delivery.price');
        $drivers = $this->config->get('ecommerce-suite.delivery.drivers');

        return match ($driver) {
            'math' => new MathHaversineDriver($price),
            'google' => new GoogleDistanceMatrixDriver($this->http, $drivers['google'], $price),
            'yandex' => new YandexMapsDriver($this->http, $drivers['yandex'], $price),
            default => throw new InvalidArgumentException("Unknown delivery driver [{$driver}]."),
        };
    }
}
