<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FoodtypeSeeder::class);
        // \App\Models\Foodtype::factory(10)->create();

        // \App\Models\Foodtype::factory()->create([ 'name' => 'Chilean' ]);
    }
}