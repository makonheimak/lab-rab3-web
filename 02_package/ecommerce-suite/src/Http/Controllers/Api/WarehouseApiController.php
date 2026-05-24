<?php

namespace MaksimYurash\EcommerceSuite\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use MaksimYurash\EcommerceSuite\Http\Controllers\Api\Concerns\FiltersApiQuery;
use MaksimYurash\EcommerceSuite\Http\Requests\StoreWarehouseRequest;
use MaksimYurash\EcommerceSuite\Http\Requests\UpdateWarehouseRequest;
use MaksimYurash\EcommerceSuite\Http\Resources\WarehouseCollection;
use MaksimYurash\EcommerceSuite\Http\Resources\WarehouseResource;
use MaksimYurash\EcommerceSuite\Models\Warehouse;

class WarehouseApiController extends Controller
{
    use FiltersApiQuery;

    public function index(Request $request): WarehouseCollection
    {
        $query = Warehouse::query();
        $this->applyBaseFilters($query, $request);

        return new WarehouseCollection($query->latest()->paginate($this->perPage($request)));
    }

    public function store(StoreWarehouseRequest $request): JsonResponse
    {
        $warehouse = Warehouse::query()->create($request->validated());

        return (new WarehouseResource($warehouse))->response()->setStatusCode(201);
    }

    public function show(int $id): WarehouseResource
    {
        return new WarehouseResource(Warehouse::query()->findOrFail($id));
    }

    public function update(UpdateWarehouseRequest $request, int $id): WarehouseResource
    {
        $warehouse = Warehouse::query()->findOrFail($id);
        $warehouse->update($request->validated());

        return new WarehouseResource($warehouse->refresh());
    }

    public function destroy(int $id): JsonResponse
    {
        Warehouse::query()->findOrFail($id)->delete();

        return response()->json(['deleted' => true]);
    }
}
