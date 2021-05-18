<?php

namespace Database\Factories;

use App\Models\BusinessAddress;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BusinessAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BusinessAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'business_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'address' => $this->faker->address(),
            'latitude' => $this->faker->latitude($min = -90, $max = 90), 
            'longitude' => $this->faker->longitude($min = -90, $max = 90), 
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
}
