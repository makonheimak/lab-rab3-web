<?php

namespace MaksimYurash\EcommerceSuite\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'supplier_id' => $this->supplier_id,
            'warehouse_id' => $this->warehouse_id,
            'name' => $this->name,
            'sku' => $this->sku,
            'description' => $this->description,
            'price' => $this->price,
            'currency' => $this->currency,
            'weight' => $this->weight,
            'cover_path' => $this->cover_path,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'created_at' => optional($this->created_at)->toISOString(),
            'updated_at' => optional($this->updated_at)->toISOString(),
            'category' => $this->whenLoaded('category'),
            'supplier' => $this->whenLoaded('supplier'),
            'warehouse' => $this->whenLoaded('warehouse'),
        ];
    }
}
