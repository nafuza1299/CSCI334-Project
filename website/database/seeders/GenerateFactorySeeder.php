<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GenerateFactorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserFactorySeeder::class,
            BusinessFactorySeeder::class,
            BusinessAddressFactorySeeder::class,
            HealthStaffFactorySeeder::class,
            CheckInFactorySeeder::class,
            HealthOrgStatisticFactorySeeder::class,
            TestResultFactorySeeder::class
        ]);
    }
}

