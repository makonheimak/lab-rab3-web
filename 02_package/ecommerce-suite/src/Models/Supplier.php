<?php

namespace MaksimYurash\EcommerceSuite\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MaksimYurash\EcommerceSuite\Database\Factories\SupplierFactory;
use MaksimYurash\EcommerceSuite\Models\Concerns\UsesPackageTablePrefix;

class Supplier extends Model
{
    use HasFactory;
    use UsesPackageTablePrefix;

    protected string $packageTableName = 'suppliers';

    protected $fillable = ['name', 'contact_person', 'email', 'phone', 'address', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function newFactory(): SupplierFactory
    {
        return SupplierFactory::new();
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

}
