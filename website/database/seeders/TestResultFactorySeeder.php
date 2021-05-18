<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TestResult;

class TestResultFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TestResult::factory()->count(env('SEED_LIMIT'))->create();
    }
}
