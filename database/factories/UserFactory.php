<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->name,
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => '$2y$04$McfRkmoTPSizsm2yzsGOKO6OykP5GDQevu.p990/P7K1857qZUdR6'
        ];
    }
}
