<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        $prefix = config('ecommerce-suite.table_prefix', 'mshop_');
        Schema::create($prefix . 'products', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('category_id')->constrained($prefix . 'categories')->cascadeOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained($prefix . 'suppliers')->nullOnDelete();
            $table->foreignId('warehouse_id')->nullable()->constrained($prefix . 'warehouses')->nullOnDelete();
            $table->string('name');
            $table->string('sku')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->char('currency', 3)->default('RUB');
            $table->decimal('weight', 8, 3)->default(0);
            $table->string('cover_path')->nullable();
            $table->unsignedInteger('quantity')->default(0);
            $table->string('status')->default('draft')->index();
            $table->timestamps();

            $table->index(['category_id', 'status']);
            $table->index(['supplier_id']);
            $table->index(['warehouse_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('ecommerce-suite.table_prefix', 'mshop_') . 'products');
    }
};
