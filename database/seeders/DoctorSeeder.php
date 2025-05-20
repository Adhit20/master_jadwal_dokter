<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Doctor::create([
            'doctor_name' => 'dr. Gladefa Imam Cesyo'
        ]);

        Doctor::create([
            'doctor_name' => 'dr. Amanda Putri'
        ]);

        Doctor::create([
            'doctor_name' => 'dr. Budi Santoso, Sp.PD'
        ]);
    }
}
