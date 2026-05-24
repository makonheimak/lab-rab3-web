<?php

namespace MaksimYurash\EcommerceSuite\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use MaksimYurash\EcommerceSuite\Facades\CurrencyRate;
use MaksimYurash\EcommerceSuite\Facades\DeliveryCost;

class UtilityApiController extends Controller
{
    public function currency(?string $code = null): JsonResponse
    {
        return response()->json($code ? [strtoupper($code) => CurrencyRate::get($code)] : CurrencyRate::all());
    }

    public function delivery(Request $request): JsonResponse
    {
        $data = $request->validate([
            'from' => ['required'],
            'to' => ['required'],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'driver' => ['nullable', 'in:math,google,yandex'],
        ]);

        return response()->json(DeliveryCost::calculate(
            $data['from'],
            $data['to'],
            (float) ($data['weight'] ?? 1),
            $data['driver'] ?? null,
        ));
    }
}
