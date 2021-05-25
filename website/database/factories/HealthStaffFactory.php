<?php

namespace Database\Factories;

use App\Models\HealthStaff;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class HealthStaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HealthStaff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->unique($reset = true)->numberBetween($min = 3, $max = env('SEED_LIMIT')/5+2),
            'position'=> $this->faker->jobTitle,
            'business_id' => $this->faker->numberBetween($min = 1, $max = env('SEED_LIMIT')/5),
            'health_org_email' => $this->faker->safeEmail(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */

}
