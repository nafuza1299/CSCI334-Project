<?php

namespace Database\Factories;

use App\Models\TestResult;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TestResultFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TestResult::class;

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
            'test_date' => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
            'infected' => (int) $this->faker->boolean(50),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */

}
