<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(),
            'email' => $this->faker->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'address' => $this->faker->address(),
            'phone_number' => $this->faker->numerify('02########'),
            'date_of_birth' => $this->faker->date(),
        
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

    // indicates that the model should be infected
    public function infected()
    {
        return $this->state(function (array $attributes) {
            return [
                'infected' => 1,
            ];
        });
    }

    // indicates that the model should be vaccinated
    public function vaccinated()
    {
        return $this->state(function (array $attributes) {
            return [
                'vaccinated' => 1,
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
}
