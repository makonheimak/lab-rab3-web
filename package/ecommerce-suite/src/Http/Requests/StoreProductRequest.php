<?php

namespace MaksimYurash\EcommerceSuite\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer'],
            'supplier_id' => ['nullable', 'integer'],
            'warehouse_id' => ['nullable', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'size:3'],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'cover_path' => ['nullable', 'string', 'max:255'],
            'quantity' => ['integer', 'min:0'],
            'status' => ['required', 'in:draft,published,archived'],
        ];
    }
}
