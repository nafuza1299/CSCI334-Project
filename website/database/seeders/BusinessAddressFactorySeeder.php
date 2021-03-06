<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BusinessAddress;

class BusinessAddressFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BusinessAddress::factory()->count(env('SEED_LIMIT'))->create();
    }
}
