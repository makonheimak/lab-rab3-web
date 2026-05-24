<?php

namespace MaksimYurash\EcommerceSuite\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use MaksimYurash\EcommerceSuite\Http\Controllers\Api\Concerns\FiltersApiQuery;
use MaksimYurash\EcommerceSuite\Http\Requests\StoreOrderRequest;
use MaksimYurash\EcommerceSuite\Http\Requests\UpdateOrderRequest;
use MaksimYurash\EcommerceSuite\Http\Resources\OrderCollection;
use MaksimYurash\EcommerceSuite\Http\Resources\OrderResource;
use MaksimYurash\EcommerceSuite\Models\Order;

class OrderApiController extends Controller
{
    use FiltersApiQuery;

    public function index(Request $request): OrderCollection
    {
        $query = Order::query()->with(['customer', 'items']);
        $this->applyBaseFilters($query, $request);

        return new OrderCollection($query->latest()->paginate($this->perPage($request)));
    }

    public function store(StoreOrderRequest $request): JsonResponse
    {
        $order = Order::query()->create($request->validated());

        return (new OrderResource($order))->response()->setStatusCode(201);
    }

    public function show(int $id): OrderResource
    {
        return new OrderResource(Order::query()->with(['customer', 'items'])->findOrFail($id));
    }

    public function update(UpdateOrderRequest $request, int $id): OrderResource
    {
        $order = Order::query()->findOrFail($id);
        $order->update($request->validated());

        return new OrderResource($order->refresh());
    }

    public function destroy(int $id): JsonResponse
    {
        Order::query()->findOrFail($id)->delete();

        return response()->json(['deleted' => true]);
    }
}
