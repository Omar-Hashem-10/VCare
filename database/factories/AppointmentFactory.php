<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start_time = $this->faker->dateTimeBetween('now', '+1 week');
        $end_time = (clone $start_time)->modify('+6 hour');

        return [
            'appointment_date' => $start_time->format('Y-m-d'),
            'start_time' => $start_time->format('H:i:s'),
            'end_time' => $end_time->format('H:i:s'),
        ];
    }
}
