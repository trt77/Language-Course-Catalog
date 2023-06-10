<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Facility>
 */
class FacilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['School', 'University', 'Learning Club', 'Study Center', 'Education Hub'];


        return [
            'name' => $this->faker->randomElement($types) . ' ' . $this->faker->lastName(),
            'address' => $this->faker->address,
        ];
    }
}
