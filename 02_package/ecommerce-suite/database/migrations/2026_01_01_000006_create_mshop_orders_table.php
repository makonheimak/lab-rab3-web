<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        $prefix = config('ecommerce-suite.table_prefix', 'mshop_');
        Schema::create($prefix . 'orders', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('customer_id')->constrained($prefix . 'customers')->cascadeOnDelete();
            $table->string('number')->unique();
            $table->string('status')->default('new')->index();
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->char('currency', 3)->default('RUB');
            $table->string('delivery_from')->nullable();
            $table->string('delivery_to')->nullable();
            $table->decimal('delivery_cost', 12, 2)->default(0);
            $table->timestamp('placed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('ecommerce-suite.table_prefix', 'mshop_') . 'orders');
    }
};
