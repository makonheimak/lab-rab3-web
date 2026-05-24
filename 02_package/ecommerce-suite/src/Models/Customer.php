<?php

namespace MaksimYurash\EcommerceSuite\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MaksimYurash\EcommerceSuite\Database\Factories\CustomerFactory;
use MaksimYurash\EcommerceSuite\Models\Concerns\UsesPackageTablePrefix;

class Customer extends Model
{
    use HasFactory;
    use UsesPackageTablePrefix;

    protected string $packageTableName = 'customers';

    protected $fillable = ['full_name', 'email', 'phone', 'address', 'registered_at'];

    protected $casts = [
        'registered_at' => 'datetime',
    ];

    protected static function newFactory(): CustomerFactory
    {
        return CustomerFactory::new();
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

}
