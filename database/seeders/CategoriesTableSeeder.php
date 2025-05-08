<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Custom T-Shirts',
                'slug' => Str::slug('T-Shirts'),
                'preview_image' => '/categories/tshirts.png',
                'description' => 'Available in plain and customized branding',
                'gender' => json_encode(['men', 'women', 'unisex']),
                'bgcolor' => '#007b51',
                'sizes' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
            ],
            [
                'name' => 'Vest',
                'slug' => Str::slug('vest'),
                'preview_image' => '/categories/vest.png',
                'description' => 'Available in plain and customized branding',
                'gender' => json_encode(['men', 'women', 'unisex']),
                'bgcolor' => '#113559',
                'sizes' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
            ],
            [
                'name' => 'Cap',
                'slug' => Str::slug('Caps'),
                'preview_image' => '/categories/caps.png',
                'description' => 'Custom-branded caps for events and promotions.',
                'gender' => json_encode(['unisex']),
                'bgcolor' => '#f6c648',
                'sizes' => json_encode(['One Size']),
            ],
            [
                'name' => 'Hoodies',
                'slug' => Str::slug('Hoodies'),
                'preview_image' => '/categories/hoodies.png',
                'description' => 'Comfortable and stylish hoodies for branding and personalization.',
                'gender' => json_encode(['men', 'women', 'unisex']),
                'bgcolor' => '#b1a79e',
                'sizes' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
            ],
            [
                'name' => 'Golf T-Shirts',
                'slug' => Str::slug('Golf T-Shirts'),
                'preview_image' => '/categories/polos.png',
                'description' => 'Premium quality golf shirts for corporate and casual wear.',
                'gender' => json_encode(['men', 'women']),
                'bgcolor' => '#d0d0d0',
                'sizes' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
            ],
            [
                'name' => 'Jacket',
                'slug' => Str::slug('Jacket'),
                'preview_image' => '/categories/jackets.png',
                'description' => 'Classic polos for a professional look with customization.',
                'gender' => json_encode(['men', 'women']),
                'bgcolor' => '#1b666c',
                'sizes' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
