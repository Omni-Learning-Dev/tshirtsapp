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
            $table->foreignId('client_id')->nullable();
            $table->foreignId('category_id');
            $table->string('logo_image')->nullable();
            $table->string('front_text')->nullable();
            $table->string('back_text')->nullable();
            $table->enum('status', ['initiated','pending', 'completed', 'canceled'])->default('initiated');
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->mediumText('notes')->nullable();
            $table->timestamps();
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
