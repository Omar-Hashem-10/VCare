<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Database\Seeder;
use Database\Factories\DoctorFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = 1;

        Major::factory()
            ->count(10)
            ->has(
                Doctor::factory()
                    ->count(2)
                    ->state(function (array $attributes) use ($userId) {
                        return [
                            'user_id' => $userId,
                        ];
                    })
                    ->has(
                        Appointment::factory()
                            ->count(3)
                    )
            )
            ->create();
    }
}
