<?php

namespace MaksimYurash\EcommerceSuite\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use MaksimYurash\EcommerceSuite\Http\Controllers\Api\Concerns\FiltersApiQuery;
use MaksimYurash\EcommerceSuite\Http\Requests\StoreSupplierRequest;
use MaksimYurash\EcommerceSuite\Http\Requests\UpdateSupplierRequest;
use MaksimYurash\EcommerceSuite\Http\Resources\SupplierCollection;
use MaksimYurash\EcommerceSuite\Http\Resources\SupplierResource;
use MaksimYurash\EcommerceSuite\Models\Supplier;

class SupplierApiController extends Controller
{
    use FiltersApiQuery;

    public function index(Request $request): SupplierCollection
    {
        $query = Supplier::query();
        $this->applyBaseFilters($query, $request);

        return new SupplierCollection($query->latest()->paginate($this->perPage($request)));
    }

    public function store(StoreSupplierRequest $request): JsonResponse
    {
        $supplier = Supplier::query()->create($request->validated());

        return (new SupplierResource($supplier))->response()->setStatusCode(201);
    }

    public function show(int $id): SupplierResource
    {
        return new SupplierResource(Supplier::query()->findOrFail($id));
    }

    public function update(UpdateSupplierRequest $request, int $id): SupplierResource
    {
        $supplier = Supplier::query()->findOrFail($id);
        $supplier->update($request->validated());

        return new SupplierResource($supplier->refresh());
    }

    public function destroy(int $id): JsonResponse
    {
        Supplier::query()->findOrFail($id)->delete();

        return response()->json(['deleted' => true]);
    }
}
