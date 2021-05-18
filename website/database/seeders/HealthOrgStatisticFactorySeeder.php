<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HealthOrgStatistic;

class HealthOrgStatisticFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HealthOrgStatistic::factory()->count(env('SEED_LIMIT'))->create();
    }
}
