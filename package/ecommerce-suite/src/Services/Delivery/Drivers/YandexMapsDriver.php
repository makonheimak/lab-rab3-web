<?php

namespace MaksimYurash\EcommerceSuite\Services\Delivery\Drivers;

use Illuminate\Http\Client\Factory as HttpFactory;
use MaksimYurash\EcommerceSuite\Services\Delivery\Contracts\DeliveryDriver;
use MaksimYurash\EcommerceSuite\Services\Delivery\DeliveryResult;
use RuntimeException;

class YandexMapsDriver extends AbstractDriver implements DeliveryDriver
{
    public function __construct(
        private readonly HttpFactory $http,
        private readonly array $config,
        private readonly array $priceConfig,
    ) {}

    public function calculate(array|string $from, array|string $to, float $weightKg = 1.0): DeliveryResult
    {
        if (empty($this->config['key'])) {
            throw new RuntimeException('Yandex Maps API key is not configured.');
        }

        $origins = is_array($from) ? $from['lng'] . ',' . $from['lat'] : $from;
        $destinations = is_array($to) ? $to['lng'] . ',' . $to['lat'] : $to;

        $response = $this->http->timeout(10)->withHeaders([
            'Authorization' => 'Api-Key ' . $this->config['key'],
        ])->get($this->config['endpoint'], [
            'origins' => $origins,
            'destinations' => $destinations,
        ]);

        if (!$response->successful()) {
            throw new RuntimeException('Yandex Maps API request failed.');
        }

        $distanceMeters = (float) data_get($response->json(), 'rows.0.elements.0.distance.value', 0);
        if ($distanceMeters <= 0) {
            throw new RuntimeException('Yandex Maps API returned empty distance.');
        }

        $distanceKm = $distanceMeters / 1000;
        $price = $this->priceByDistance($distanceKm, $weightKg, $this->priceConfig);

        return new DeliveryResult('yandex', $distanceKm, $price, ['provider' => 'Yandex Maps']);
    }
}
