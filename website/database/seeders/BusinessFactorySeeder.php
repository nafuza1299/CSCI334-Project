<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Business;

class BusinessFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $businesss = Business::factory()->count(env('SEED_LIMIT')/8)->health()->create();

        Business::factory()->count(env('SEED_LIMIT')*7/8)->create();
    }
}
