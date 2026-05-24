<?php

namespace MaksimYurash\EcommerceSuite\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use MaksimYurash\EcommerceSuite\Http\Controllers\Api\Concerns\FiltersApiQuery;
use MaksimYurash\EcommerceSuite\Http\Requests\StoreProductRequest;
use MaksimYurash\EcommerceSuite\Http\Requests\UpdateProductRequest;
use MaksimYurash\EcommerceSuite\Http\Resources\ProductCollection;
use MaksimYurash\EcommerceSuite\Http\Resources\ProductResource;
use MaksimYurash\EcommerceSuite\Models\Product;

class ProductApiController extends Controller
{
    use FiltersApiQuery;

    public function index(Request $request): ProductCollection
    {
        $query = Product::query()->with(['category', 'supplier', 'warehouse']);
        $this->applyBaseFilters($query, $request);

        return new ProductCollection($query->latest()->paginate($this->perPage($request)));
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = Product::query()->create($request->validated());

        return (new ProductResource($product))->response()->setStatusCode(201);
    }

    public function show(int $id): ProductResource
    {
        return new ProductResource(Product::query()->with(['category', 'supplier', 'warehouse'])->findOrFail($id));
    }

    public function update(UpdateProductRequest $request, int $id): ProductResource
    {
        $product = Product::query()->findOrFail($id);
        $product->update($request->validated());

        return new ProductResource($product->refresh());
    }

    public function destroy(int $id): JsonResponse
    {
        Product::query()->findOrFail($id)->delete();

        return response()->json(['deleted' => true]);
    }
}
