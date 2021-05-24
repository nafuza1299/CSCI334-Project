<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('businesses')->insert([
            'name' => 'Hospital1',
            'username' => 'health',
            'email' => 'health@test.com',
            'phone_number' => '01234567890',
            'type' => 'Health',
            'verified' => true,
            'password' => Hash::make('password'),
        ]);
        DB::table('business_addresses')->insert([
            'business_id' => 1,
            'address' => 'test',
            'latitude' => '13',
            'longitude' => '13',
        ]);
        DB::table('businesses')->insert([
            'name' => 'Business',
            'username' => 'business',
            'email' => 'Business@test.com',
            'phone_number' => '01234567890',
            'type' => 'Business',
            'verified' => true,
            'password' => Hash::make('password'),
        ]);
        DB::table('business_addresses')->insert([
            'business_id' => 2,
            'address' => 'Business',
            'latitude' => '13',
            'longitude' => '13',
        ]);
    }
}
