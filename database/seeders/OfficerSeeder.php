<?php

namespace Database\Seeders;

use App\Models\Officer;
use Illuminate\Database\Seeder;

class OfficerSeeder extends Seeder
{
    public function run(): void
    {
        $officers = [
            [
                'name' => 'John Doe',
                'phone' => '081234567890',
                'email' => 'john@example.com',
                'area' => 'TPS Ciroyom',
                'gender' => 'male',
                'schedule_days' => 'Senin, Rabu, Jumat'
            ],
            [
                'name' => 'Jane Smith',
                'phone' => '081234567891',
                'email' => 'jane@example.com',
                'area' => 'TPS Balubur',
                'gender' => 'female',
                'schedule_days' => 'Selasa, Kamis, Sabtu'
            ]
        ];

        foreach ($officers as $officer) {
            Officer::create($officer);
        }
    }
}
