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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained();
            $table->string('product_name');
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->string('size')->nullable();
            $table->string('color')->nullable(); // Standard color selection
            $table->string('custom_color')->nullable(); // Custom color specified by client
            $table->boolean('is_custom_color')->default(false); // Flag to indicate if custom color was used
            $table->string('logo_path')->nullable(); // Path to uploaded logo file
            $table->text('branding_instructions')->nullable();
            $table->boolean('has_customization')->default(false); // Whether customization was requested
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
