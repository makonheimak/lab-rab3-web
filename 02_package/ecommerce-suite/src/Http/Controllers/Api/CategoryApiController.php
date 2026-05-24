<?php

namespace MaksimYurash\EcommerceSuite\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use MaksimYurash\EcommerceSuite\Http\Controllers\Api\Concerns\FiltersApiQuery;
use MaksimYurash\EcommerceSuite\Http\Requests\StoreCategoryRequest;
use MaksimYurash\EcommerceSuite\Http\Requests\UpdateCategoryRequest;
use MaksimYurash\EcommerceSuite\Http\Resources\CategoryCollection;
use MaksimYurash\EcommerceSuite\Http\Resources\CategoryResource;
use MaksimYurash\EcommerceSuite\Models\Category;

class CategoryApiController extends Controller
{
    use FiltersApiQuery;

    public function index(Request $request): CategoryCollection
    {
        $query = Category::query();
        $this->applyBaseFilters($query, $request);

        return new CategoryCollection($query->latest()->paginate($this->perPage($request)));
    }

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $category = Category::query()->create($request->validated());

        return (new CategoryResource($category))->response()->setStatusCode(201);
    }

    public function show(int $id): CategoryResource
    {
        return new CategoryResource(Category::query()->findOrFail($id));
    }

    public function update(UpdateCategoryRequest $request, int $id): CategoryResource
    {
        $category = Category::query()->findOrFail($id);
        $category->update($request->validated());

        return new CategoryResource($category->refresh());
    }

    public function destroy(int $id): JsonResponse
    {
        Category::query()->findOrFail($id)->delete();

        return response()->json(['deleted' => true]);
    }
}
