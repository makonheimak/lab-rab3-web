<?php

namespace MaksimYurash\EcommerceSuite\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MaksimYurash\EcommerceSuite\Database\Factories\OrderFactory;
use MaksimYurash\EcommerceSuite\Models\Concerns\UsesPackageTablePrefix;

class Order extends Model
{
    use HasFactory;
    use UsesPackageTablePrefix;

    protected string $packageTableName = 'orders';

    protected $fillable = ['customer_id', 'number', 'status', 'total_amount', 'currency', 'delivery_from', 'delivery_to', 'delivery_cost', 'placed_at'];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'delivery_cost' => 'decimal:2',
        'placed_at' => 'datetime',
    ];

    protected static function newFactory(): OrderFactory
    {
        return OrderFactory::new();
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

}
