<?php

namespace MaksimYurash\EcommerceSuite\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use MaksimYurash\EcommerceSuite\Http\Controllers\Api\Concerns\FiltersApiQuery;
use MaksimYurash\EcommerceSuite\Http\Requests\StoreCustomerRequest;
use MaksimYurash\EcommerceSuite\Http\Requests\UpdateCustomerRequest;
use MaksimYurash\EcommerceSuite\Http\Resources\CustomerCollection;
use MaksimYurash\EcommerceSuite\Http\Resources\CustomerResource;
use MaksimYurash\EcommerceSuite\Models\Customer;

class CustomerApiController extends Controller
{
    use FiltersApiQuery;

    public function index(Request $request): CustomerCollection
    {
        $query = Customer::query();
        $this->applyBaseFilters($query, $request);

        return new CustomerCollection($query->latest()->paginate($this->perPage($request)));
    }

    public function store(StoreCustomerRequest $request): JsonResponse
    {
        $customer = Customer::query()->create($request->validated());

        return (new CustomerResource($customer))->response()->setStatusCode(201);
    }

    public function show(int $id): CustomerResource
    {
        return new CustomerResource(Customer::query()->findOrFail($id));
    }

    public function update(UpdateCustomerRequest $request, int $id): CustomerResource
    {
        $customer = Customer::query()->findOrFail($id);
        $customer->update($request->validated());

        return new CustomerResource($customer->refresh());
    }

    public function destroy(int $id): JsonResponse
    {
        Customer::query()->findOrFail($id)->delete();

        return response()->json(['deleted' => true]);
    }
}
