<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Teacher;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->firstName();
        $surname = $this->faker->lastName();

        $files = glob(public_path('images') . '/*.jpg');
        static $i = 0;

        $pictureName = basename($files[$i++], '.jpg');

        return [
            'name' => $name,
            'surname' => $surname,
            'education' => $this->faker->randomElement(['Harvard University', 'Oxford University', 'Cambridge University', 'Stanford University']),
            'phone' => $this->faker->e164PhoneNumber,
            'email' => $this->faker->unique()->safeEmail(),
            'picture' => 'images/' . $pictureName . '.jpg',
        ];
    }
}
