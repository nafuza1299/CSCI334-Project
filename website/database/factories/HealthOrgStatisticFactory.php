<?php

namespace Database\Factories;

use App\Models\HealthOrgStatistic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class HealthOrgStatisticFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HealthOrgStatistic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'business_id' => $this->faker->unique($reset = true)->numberBetween($min = 3, $max = env('SEED_LIMIT')/8 + 2),
            'infected' => $this->faker->numberBetween($min = 1, $max = 1000),
            'deaths' => $this->faker->numberBetween($min = 1, $max = 1000),
            'recovered' => $this->faker->numberBetween($min = 1, $max = 1000),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */

}
