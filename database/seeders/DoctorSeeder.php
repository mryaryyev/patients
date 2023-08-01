<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = [
            ['name'=>'Myrat','surname'=>'Nazarow'],
            ['name'=>'Maksat','surname'=>'Begenjow'],
            ['name'=>'Didar','surname'=>'Berdiyew'],
            ['name'=>'Nurgeldi','surname'=>'Payzyyew'],
            ['name'=>'Batyr','surname'=>'Chopanow'],
        ];

        foreach ($doctors as $doctor) {
            $obj = new Doctor();
            $obj->name = $doctor['name'];
            $obj->surname = $doctor['surname'];
            $obj->save();
        }
    }
}
