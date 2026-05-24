<?php

namespace MaksimYurash\EcommerceSuite\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MaksimYurash\EcommerceSuite\Database\Factories\WarehouseFactory;
use MaksimYurash\EcommerceSuite\Models\Concerns\UsesPackageTablePrefix;

class Warehouse extends Model
{
    use HasFactory;
    use UsesPackageTablePrefix;

    protected string $packageTableName = 'warehouses';

    protected $fillable = ['title', 'address', 'latitude', 'longitude', 'capacity', 'is_active'];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'capacity' => 'integer',
        'is_active' => 'boolean',
    ];

    protected static function newFactory(): WarehouseFactory
    {
        return WarehouseFactory::new();
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

}
