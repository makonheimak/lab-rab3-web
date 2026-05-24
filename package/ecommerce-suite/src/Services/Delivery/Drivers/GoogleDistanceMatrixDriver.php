<?php

namespace MaksimYurash\EcommerceSuite\Services\Delivery\Drivers;

use Illuminate\Http\Client\Factory as HttpFactory;
use MaksimYurash\EcommerceSuite\Services\Delivery\Contracts\DeliveryDriver;
use MaksimYurash\EcommerceSuite\Services\Delivery\DeliveryResult;
use RuntimeException;

class GoogleDistanceMatrixDriver extends AbstractDriver implements DeliveryDriver
{
    public function __construct(
        private readonly HttpFactory $http,
        private readonly array $config,
        private readonly array $priceConfig,
    ) {}

    public function calculate(array|string $from, array|string $to, float $weightKg = 1.0): DeliveryResult
    {
        if (empty($this->config['key'])) {
            throw new RuntimeException('Google Distance Matrix API key is not configured.');
        }

        $response = $this->http->timeout(10)->get($this->config['endpoint'], [
            'origins' => is_array($from) ? $from['lat'] . ',' . $from['lng'] : $from,
            'destinations' => is_array($to) ? $to['lat'] . ',' . $to['lng'] : $to,
            'key' => $this->config['key'],
            'units' => 'metric',
        ]);

        if (!$response->successful()) {
            throw new RuntimeException('Google Distance Matrix API request failed.');
        }

        $distanceMeters = (float) data_get($response->json(), 'rows.0.elements.0.distance.value', 0);
        if ($distanceMeters <= 0) {
            throw new RuntimeException('Google Distance Matrix API returned empty distance.');
        }

        $distanceKm = $distanceMeters / 1000;
        $price = $this->priceByDistance($distanceKm, $weightKg, $this->priceConfig);

        return new DeliveryResult('google', $distanceKm, $price, ['provider' => 'Google Distance Matrix']);
    }
}
