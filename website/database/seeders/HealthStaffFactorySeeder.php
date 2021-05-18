<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HealthStaff;

class HealthStaffFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HealthStaff::factory()->count(env('SEED_LIMIT'))->create();
    }
}
