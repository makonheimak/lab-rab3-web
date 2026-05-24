<?php

namespace MaksimYurash\EcommerceSuite\Services\Currency;

use Illuminate\Cache\Repository as CacheRepository;
use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Http\Client\Factory as HttpFactory;
use RuntimeException;
use SimpleXMLElement;

class CurrencyRateManager
{
    public function __construct(
        private readonly CacheRepository $cache,
        private readonly ConfigRepository $config,
        private readonly HttpFactory $http,
    ) {}

    public function all(): array
    {
        $ttl = (int) $this->config->get('ecommerce-suite.currency.cache_ttl', 3600);

        return $this->cache->remember('ecommerce-suite.currency.cbr', $ttl, function () {
            $url = $this->config->get('ecommerce-suite.currency.cbr_url');
            $response = $this->http->timeout(10)->get($url);

            if (!$response->successful()) {
                throw new RuntimeException('Currency provider is not available.');
            }

            $xml = new SimpleXMLElement($response->body());
            $rates = ['RUB' => 1.0];

            foreach ($xml->Valute as $valute) {
                $code = (string) $valute->CharCode;
                $nominal = (float) str_replace(',', '.', (string) $valute->Nominal);
                $value = (float) str_replace(',', '.', (string) $valute->Value);
                $rates[$code] = round($value / max($nominal, 1), 6);
            }

            return $rates;
        });
    }

    public function get(string $currency = 'USD'): float
    {
        $currency = strtoupper($currency);
        $rates = $this->all();

        if (!array_key_exists($currency, $rates)) {
            throw new RuntimeException("Currency {$currency} is not found in current provider response.");
        }

        return (float) $rates[$currency];
    }

    public function convert(float $amount, string $from, string $to = 'RUB'): float
    {
        $from = strtoupper($from);
        $to = strtoupper($to);
        $rates = $this->all();

        if (!isset($rates[$from], $rates[$to])) {
            throw new RuntimeException('Cannot convert unknown currency.');
        }

        $amountInRub = $amount * $rates[$from];
        return round($amountInRub / $rates[$to], 2);
    }
}
