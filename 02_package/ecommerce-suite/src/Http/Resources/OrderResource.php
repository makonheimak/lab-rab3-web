<?php

namespace MaksimYurash\EcommerceSuite\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'number' => $this->number,
            'status' => $this->status,
            'total_amount' => $this->total_amount,
            'currency' => $this->currency,
            'delivery_from' => $this->delivery_from,
            'delivery_to' => $this->delivery_to,
            'delivery_cost' => $this->delivery_cost,
            'placed_at' => $this->placed_at,
            'created_at' => optional($this->created_at)->toISOString(),
            'updated_at' => optional($this->updated_at)->toISOString(),
            'customer' => $this->whenLoaded('customer'),
            'items' => $this->whenLoaded('items'),
        ];
    }
}
