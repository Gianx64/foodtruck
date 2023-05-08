<?php

namespace Database\Seeders;

use App\Models\Foodtype;
use Illuminate\Database\Seeder;

class FoodtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Foodtype::create(['name' => 'Burger']);
        Foodtype::create(['name' => 'Corn']);
        Foodtype::create(['name' => 'Hot Dogs']);
        Foodtype::create(['name' => 'Tacos']);
        Foodtype::create(['name' => 'Vegan']);
    }
}
