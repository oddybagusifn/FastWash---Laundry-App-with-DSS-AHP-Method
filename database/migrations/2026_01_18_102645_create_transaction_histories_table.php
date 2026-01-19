<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laundry_transaction_id')
            ->constrained('laundry_transactions')
            ->cascadeOnDelete();
            $table->string('customer_name', 100);
            $table->string('phone_number', 20);
            $table->decimal('laundry_weight', 6, 2);
            $table->decimal('total_price', 12, 2);
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_histories');
    }
};
