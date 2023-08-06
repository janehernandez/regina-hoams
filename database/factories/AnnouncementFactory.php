<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = Carbon::createFromTimeStamp($this->faker->dateTimeBetween('-30 days', '+30 days')->getTimestamp());
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $startDate)->addDays(20);
        $now = Carbon::now();

        return [
            'title' => $this->faker->unique()->sentence(8),
            'content' => $this->faker->paragraphs(5, true),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'active' => ($now >= $startDate) && ($now <= $endDate)
        ];
    }
}
