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
            'password' => Hash::make('Pp#ssw@rd54'),
        ]);

        $this->call([
            CategoriesTableSeeder::class,
            PricesTableSeeder::class,
        ]);
    }
}
