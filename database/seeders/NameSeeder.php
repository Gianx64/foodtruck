<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('foodtypes')->insert(['name' => 'Burger']);
        DB::table('foodtypes')->insert(['name' => 'Corn']);
        DB::table('foodtypes')->insert(['name' => 'Hot Dogs']);
        DB::table('foodtypes')->insert(['name' => 'Tacos']);
        DB::table('foodtypes')->insert(['name' => 'Vegan']);

        DB::table('documentnames')->insert(['name' => 'Driving License']);
        DB::table('documentnames')->insert(['name' => 'Proof of Insurance']);
        DB::table('documentnames')->insert(['name' => 'Vehicle Registration']);
    }
}
