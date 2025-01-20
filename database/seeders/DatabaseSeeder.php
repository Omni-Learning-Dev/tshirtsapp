<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Adminstrator',
            'email' => 'admin@capital.creative',
            'role'  => 'admin',
            'password'=> Hash::make('Pp#ssw@rd54'),
        ]);

        $categories = [
            [
                'name' => 'T-Shirts',
                'slug' => Str::slug('T-Shirts'),
                'preview_image' => '/categories/tshirts.png',
                'description' => 'Customizable branded T-shirts for all occasions.',
                'gender' => json_encode(['men', 'women', 'unisex']),
                'sizes' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
            ],
            [
                'name' => 'Golf Shirts',
                'slug' => Str::slug('Golf Shirts'),
                'preview_image' => '/categories/golf_shirts.png',
                'description' => 'Premium quality golf shirts for corporate and casual wear.',
                'gender' => json_encode(['men', 'women']),
                'sizes' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
            ],
            [
                'name' => 'Hoodies',
                'slug' => Str::slug('Hoodies'),
                'preview_image' => '/categories/hoodies.png',
                'description' => 'Comfortable and stylish hoodies for branding and personalization.',
                'gender' => json_encode(['men', 'women', 'unisex']),
                'sizes' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
            ],
            [
                'name' => 'Caps',
                'slug' => Str::slug('Caps'),
                'preview_image' => '/categories/caps.png',
                'description' => 'Custom-branded caps for events and promotions.',
                'gender' => json_encode(['unisex']),
                'sizes' => json_encode(['One Size']),
            ],
            [
                'name' => 'Jackets',
                'slug' => Str::slug('Jackets'),
                'preview_image' => '/categories/jackets.png',
                'description' => 'Branded jackets for outdoor and casual wear.',
                'gender' => json_encode(['men', 'women', 'unisex']),
                'sizes' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
            ],
            [
                'name' => 'Polos',
                'slug' => Str::slug('Polos'),
                'preview_image' => '/categories/polos.png',
                'description' => 'Classic polos for a professional look with customization.',
                'gender' => json_encode(['men', 'women']),
                'sizes' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
            ],
        ];

        // Insert categories into the database
        DB::table('categories')->insert($categories);

    }
}
