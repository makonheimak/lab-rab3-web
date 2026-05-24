<?php

namespace MaksimYurash\EcommerceSuite\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public $collects = ProductResource::class;

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
