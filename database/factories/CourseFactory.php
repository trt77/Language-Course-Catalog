<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Schedule;
use App\Models\Facility;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $teacher_ids = Teacher::pluck('id')->toArray();

        return [
            'name' => $this->faker->sentence(3),
            'level' => $this->faker->randomElement(['A1', 'A2', 'B1', 'B2', 'C1', 'C2']),
            'language' => $this->faker->randomElement(['English', 'Spanish', 'French', 'German', 'Japanese', 'Chinese', 'Korean', 'Swedish', 'Russian', 'Turkish', 'Arabic', 'Italian', 'Portuguese']),
            'teacher_id' => $this->faker->randomElement($teacher_ids),
        ];
    }
}
