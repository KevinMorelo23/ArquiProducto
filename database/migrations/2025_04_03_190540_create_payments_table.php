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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained()->onDelete('cascade');
            $table->string('payment_method');
            $table->string('reference_number')->nullable();
            $table->string('card_number')->nullable();
            $table->string('cardholder_name')->nullable();
            $table->string('card_expiry')->nullable();
            $table->float('amount_tendered', 10, 2)->nullable();
            $table->string('bank_name')->nullable();
            $table->float('change', 10, 2)->nullable();
            $table->string('installments')->nullable();
            $table->string('account_number')->nullable();
            $table->float('amount', 10, 2);
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
