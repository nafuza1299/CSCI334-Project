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
            'name' => 'test',
            'username' => 'test',
            'email' => 'test@test.com',
            'phone_number' => '01234567890',
            'type' => 'Health',
            'verified' => true,
            'password' => Hash::make('password'),
        ]);

    }
}
