<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        $prefix = config('ecommerce-suite.table_prefix', 'mshop_');
        Schema::create($prefix . 'categories', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained($prefix . 'categories')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('cover_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('ecommerce-suite.table_prefix', 'mshop_') . 'categories');
    }
};
