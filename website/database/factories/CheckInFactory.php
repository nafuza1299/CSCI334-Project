<?php

namespace Database\Factories;

use App\Models\CheckIn;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CheckInFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CheckIn::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $max = env('SEED_LIMIT')),
            'business_address_id' => $this->faker->numberBetween($min = 1, $max = env('SEED_LIMIT')),
            'check_in_time' => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */

}
