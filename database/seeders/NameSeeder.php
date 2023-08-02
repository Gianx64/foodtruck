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
        DB::table('foodtypes')->insert(['name' => "Burger"]);
        DB::table('foodtypes')->insert(['name' => "Corn"]);
        DB::table('foodtypes')->insert(['name' => "Hot Dogs"]);
        DB::table('foodtypes')->insert(['name' => "Tacos"]);
        DB::table('foodtypes')->insert(['name' => "Vegan"]);

        DB::table('documentnames')->insert(['name' => "Driving License"]);
        DB::table('documentnames')->insert(['name' => "Proof of Insurance"]);
        DB::table('documentnames')->insert(['name' => "Vehicle Registration"]);
        DB::table('documentnames')->insert(['name' => "Business License"]);
        DB::table('documentnames')->insert(['name' => "Employer Identification Number"]);
        DB::table('documentnames')->insert(['name' => "Food Handler's Permit"]);
        DB::table('documentnames')->insert(['name' => "Health Department Permit"]);
        DB::table('documentnames')->insert(['name' => "Seller's Permit"]);
        DB::table('documentnames')->insert(['name' => "Fire Certificate"]);
        DB::table('documentnames')->insert(['name' => "Parking Permit"]);
        DB::table('documentnames')->insert(['name' => "Commissary Letter of Agreement"]);
        DB::table('documentnames')->insert(['name' => "Standard Operating Procedures Document"]);
        DB::table('documentnames')->insert(['name' => "Special Event Permit"]);
        DB::table('documentnames')->insert(['name' => "Certificate of Liability Insurance"]);
        DB::table('documentnames')->insert(['name' => "Mobile Food Establishments Permit"]);
        DB::table('documentnames')->insert(['name' => "Mobile Food Facility Permit"]);
        DB::table('documentnames')->insert(['name' => "Hawker and Peddler License"]);
        DB::table('documentnames')->insert(['name' => "Reseller's and Seller's Permits"]);
    }
}