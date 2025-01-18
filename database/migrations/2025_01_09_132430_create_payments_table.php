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
            $table->foreignId('order_id'); // Link to orders table
            $table->foreignId('client_id'); // Link to users table
            $table->string('payment_method'); // e.g., card, PayPal, bank transfer
            $table->string('transaction_id')->nullable(); // Unique transaction identifier
            $table->decimal('amount', 10, 2); // Payment amount
            $table->enum('status', ['successful', 'failed', 'pending'])->default('pending'); // Payment status
            $table->string('currency', 3)->default('USD'); // Currency for the payment (default to USD)
            $table->text('notes')->nullable(); // Optional notes for the payment
            $table->timestamps(); // created_at and updated_at
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
