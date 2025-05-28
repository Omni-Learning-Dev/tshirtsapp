<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Adminstrator',
            'email' => 'admin@capital.kreative',
            'role'  => 'admin',
            'password' => Hash::make('Pp#ssw@rd54'),
        ]);

        $products = [
            [
                'product_name' => 'Custom T-Shirts',
                'slug' => 't-shirts',
                'price' => 15.99,
                'sizes' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
                'colors' => json_encode(['White', 'Black', 'Navy']), // Updated: Only White, Black, Navy
                'description' => 'High-quality cotton t-shirts available in plain styles or with customized branding. Perfect for corporate events, promotions, and team uniforms.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Corporate Vests',
                'slug' => 'vests',
                'price' => 29.99,
                'sizes' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
                'colors' => json_encode(['Black']), // Updated: Only Black color
                'description' => 'Professional vests for corporate settings. Durable fabric with customizable embroidery options for your company logo.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Branded Caps',
                'slug' => 'caps',
                'price' => 12.99,
                'sizes' => json_encode(['One Size']),
                'colors' => json_encode(['White', 'Black', 'Navy']), // Unchanged
                'description' => 'Custom-branded caps for events, promotions, and corporate giveaways. Available with embroidered or printed logos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Premium Hoodies',
                'slug' => 'hoodies',
                'price' => 32.99,
                'sizes' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
                'colors' => json_encode(['Black', 'white']), // Unchanged
                'description' => 'Comfortable and stylish hoodies for branding and personalization. Ideal for corporate retreats, staff uniforms, and promotional campaigns.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Golf T-Shirts',
                'slug' => 'golf-shirts',
                'price' => 24.99,
                'sizes' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
                'colors' => json_encode(['White', 'Black', 'Navy',]), // Unchanged
                'description' => 'Premium quality golf shirts for corporate events and casual business wear. Moisture-wicking fabric with customizable embroidery options.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Corporate Jackets',
                'slug' => 'jackets',
                'price' => 49.99,
                'sizes' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
                'colors' => json_encode(['Black']), // Updated: Only Black color
                'description' => 'Professional jackets for corporate branding. Weather-resistant with multiple customization options including embroidery and patches.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('products')->insert($products);

        // Seed product images
        $productImages = [
            // Custom T-Shirts (product_id: 1)
            [
                'product_id' => 1,
                'image_path' => 'Black-Tshirt-small_00000.png',
                'is_primary' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Corporate Vests (product_id: 2)
            [
                'product_id' => 2,
                'image_path' => 'black-3d-vest-PNG.png',
                'is_primary' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Branded Caps (product_id: 3)
            [
                'product_id' => 3,
                'image_path' => 'black-cap-PNG.png',
                'is_primary' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Premium Hoodies (product_id: 4)
            [
                'product_id' => 4,
                'image_path' => 'Black-Hoodie_00000.png',
                'is_primary' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Golf T-Shirts (product_id: 5)
            [
                'product_id' => 5,
                'image_path' => 'Golf-T-shirt_00000-p-500.png',
                'is_primary' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Corporate Jackets (product_id: 6)
            [
                'product_id' => 6,
                'image_path' => 'black-jacket.png',
                'is_primary' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('product_images')->insert($productImages);

        DB::table('company_infos')->insert([
            'name' => 'Capital Kreatives',
            'address' => '149 The Chase, Mt Pleasant, Harare',
            'phone' => '+263 782 893 151',
            'whatsapp' => '+263 77 499 9472',
            'email' => 'info@capitalkreatives.com',
            'website' => 'capitalkreatives.com',
        ]);
    }
}
