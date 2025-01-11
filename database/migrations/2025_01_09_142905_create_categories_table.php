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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('preview_image')->nullable();
            $table->text('description')->nullable();
            // Gender column as enum
            $table->enum('gender', ['men', 'women', 'unisex', 'kids']);
            // Sizes column as enum
            $table->enum('sizes', [
                'XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL', '4XL', '5XL',
                '2T', '3T', '4T', '6-7', '8-10', '10-12', '12-14',
            ])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
