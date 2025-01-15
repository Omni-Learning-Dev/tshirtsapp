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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('client_id');
//            $table->foreignId('category_id');
            $table->integer('quantity');
            $table->string('logo_image')->nullable();
            $table->string('front_text')->nullable();
            $table->string('back_text')->nullable();
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'completed', 'canceled'])->default('pending');
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->enum('gender', ['men', 'women', 'unisex', 'kids']);
            $table->enum('size', [
                'XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL', '4XL', '5XL',
                '2T', '3T', '4T', '6-7', '8-10', '10-12', '12-14',
            ])->nullable();
            $table->timestamps(); // Timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
