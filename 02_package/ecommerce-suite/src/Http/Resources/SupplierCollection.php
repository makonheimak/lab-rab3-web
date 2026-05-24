<?php

namespace MaksimYurash\EcommerceSuite\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SupplierCollection extends ResourceCollection
{
    public $collects = SupplierResource::class;

    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
            'meta' => [
                'generated_by' => 'ecommerce-suite',
            ],
        ];
    }
}
