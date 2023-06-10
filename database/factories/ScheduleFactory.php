<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Schedule;
use App\Models\Facility;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
        $selectedDays = $this->faker->randomElements($days, $this->faker->numberBetween(1,7));

        usort($selectedDays, function($a, $b) use ($days) {
            return array_search($a, $days) - array_search($b, $days);
        });

        $facility_ids = Facility::pluck('id')->toArray();

        $startDate = $this->faker->dateTimeBetween('2023-06-01', '2023-12-01');

        $endDate = $this->faker->dateTimeBetween($startDate, '2023-12-30');

        return [
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'time' => $this->faker->dateTimeBetween('08:00', '20:00')->format('H:i'),
            'duration' => $this->faker->randomElement([15, 30, 45, 50, 90, 100, 120, 20, 35]),
            'days_of_week' => $selectedDays,
            'facility_id' => $this->faker->randomElement($facility_ids),
        ];
    }
}

