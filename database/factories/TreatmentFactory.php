<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Treatment>
 */
class TreatmentFactory extends Factory
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
        return [
            'department_id' => $department->id,
            'room_id' => $room->id,
            'doctor_id' => $doctor->id,
            'price' => rand(50, 500),
            'name' => fake()->name(),
            ];
    }
}
