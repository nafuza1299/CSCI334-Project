<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HealthstaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'health',
            'email' => 'test@test.com',
            'password' => Hash::make('password'),
            'first_name' => 'health',
            'last_name' => 'staff',
            'vaccinated' => true,
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => 2,
            'model_type' => 'App\Models\User',
            'model_id' => 2,
        ]);

        DB::table('health_staffs')->insert([
            'user_id' => 2,
            'position' => "General Practitioner",
            'business_id' => 1,
            'health_org_email' => "test@test.com",
            'verified' => true,
        ]);
    }
}
