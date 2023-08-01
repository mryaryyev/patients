<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registration>
 */
class RegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $department = DB::table('departments')->inRandomOrder()->first();
        $room = DB::table('rooms')->inRandomOrder()->first();
        $doctor = DB::table('doctors')->inRandomOrder()->first();
        $patient = DB::table('rooms')->inRandomOrder()->first();
        $createdAt = fake()->dateTimeBetween('-1 month', '-1 day');
        return [
            'department_id' => $department->id,
            'room_id' => $room->id,
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
            'price' => rand(50, 500),
            'created_at' => $createdAt,
            'updated_at' => Carbon::parse($createdAt)->addDays(rand(0, 6))->addHours(rand(0, 23)),
        ];
    }
}
