<?php

namespace Database\Factories;

use App\Models\Business;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BusinessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Business::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company()." ".$this->faker->companySuffix(),
            'username' => $this->faker->word."".$this->faker->randomLetter."".$this->faker->unique($reset = true)->numberBetween($min =1, $max = env('SEED_LIMIT')),
            'email' => $this->faker->safeEmail(),
            'email_verified_at' => now(),
            'type' =>  'Business',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => $this->faker->numerify('02########'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
    // indicates that the model should be verified
    public function verified()
    {
        return $this->state(function (array $attributes) {
            return [
                'verified' => 0,
            ];
        });
    }

    // indicates that the model should be disabled
    public function disabled()
    {
        return $this->state(function (array $attributes) {
            return [
                'disabled' => 1,
            ];
        });
    }
    public function health()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'health',
            ];
        });
    }
}
