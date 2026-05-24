<?php

namespace MaksimYurash\EcommerceSuite\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'integer'],
            'number' => ['required', 'string', 'max:100'],
            'status' => ['required', 'in:new,paid,shipping,completed,cancelled'],
            'total_amount' => ['numeric', 'min:0'],
            'currency' => ['required', 'string', 'size:3'],
            'delivery_from' => ['nullable', 'string', 'max:255'],
            'delivery_to' => ['nullable', 'string', 'max:255'],
            'delivery_cost' => ['numeric', 'min:0'],
            'placed_at' => ['nullable', 'date'],
        ];
    }
}
