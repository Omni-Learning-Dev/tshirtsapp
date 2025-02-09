<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all category IDs
        $categories = DB::table('categories')->pluck('id');

        $prices = [];

        foreach ($categories as $categoryId) {
            $sizes = json_decode(DB::table('categories')->where('id', $categoryId)->value('sizes'));
            $genders = json_decode(DB::table('categories')->where('id', $categoryId)->value('gender'));

            foreach ($sizes as $size) {
                foreach ($genders as $gender) {
                    $prices[] = [
                        'category_id' => $categoryId,
                        'size' => $size,
                        'gender' => $gender,
                        'usd_price' => rand(5, 10), // Random USD price between 10 and 100
                        'rtgs_price' => rand(200, 10000), // Random RTGS price between 1000 and 10000
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        DB::table('prices')->insert($prices);
    }
}
