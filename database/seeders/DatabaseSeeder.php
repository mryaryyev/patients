<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            RoomSeeder::class,
            DoctorSeeder::class,
        ]);
        \App\Models\User::factory(10)->create();
        \App\Models\Patient::factory(20)->create();
        \App\Models\Treatment::factory(30)->create();
        \App\Models\Patient::factory(20)->create();

    }
}
