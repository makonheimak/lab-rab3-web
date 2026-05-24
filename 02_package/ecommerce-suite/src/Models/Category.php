<?php

namespace MaksimYurash\EcommerceSuite\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MaksimYurash\EcommerceSuite\Database\Factories\CategoryFactory;
use MaksimYurash\EcommerceSuite\Models\Concerns\UsesPackageTablePrefix;

class Category extends Model
{
    use HasFactory;
    use UsesPackageTablePrefix;

    protected string $packageTableName = 'categories';

    protected $fillable = ['parent_id', 'name', 'slug', 'description', 'cover_path', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

}
