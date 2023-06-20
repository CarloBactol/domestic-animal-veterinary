<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name' => 'Vaccination',
            'status' => rand(0, 1)
        ]);
        Service::create([
            'name' => 'Treatment',
            'status' => rand(0, 1)
        ]);
        Service::create([
            'name' => 'Consultation',
            'status' => rand(0, 1)
        ]);
        Service::create([
            'name' => 'Deworming',
            'status' => rand(0, 1)
        ]);
        Service::create([
            'name' => 'Vitamin Injection',
            'status' => rand(0, 1)
        ]);
        Service::create([
            'name' => 'Castration',
            'status' => rand(0, 1)
        ]);
        Service::create([
            'name' => 'Spaying',
            'status' => rand(0, 1)
        ]);
        Service::create([
            'name' => 'Seminar/training',
            'status' => rand(0, 1)
        ]);
    }
}
