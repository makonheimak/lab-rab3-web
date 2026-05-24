<?php

namespace MaksimYurash\EcommerceSuite\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['sometimes', 'required', 'integer'],
            'supplier_id' => ['nullable', 'integer'],
            'warehouse_id' => ['nullable', 'integer'],
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'sku' => ['sometimes', 'required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'price' => ['sometimes', 'required', 'numeric', 'min:0'],
            'currency' => ['sometimes', 'required', 'string', 'size:3'],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'cover_path' => ['nullable', 'string', 'max:255'],
            'quantity' => ['integer', 'min:0'],
            'status' => ['sometimes', 'required', 'in:draft,published,archived'],
        ];
    }
}
