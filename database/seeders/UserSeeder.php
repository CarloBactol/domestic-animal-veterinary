<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('adminpass'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'owner',
            'email' => 'owner@email.com',
            'password' => Hash::make('ownerpass'),
            'role' => 'owner',
        ]);

        User::create([
            'name' => 'veterinary',
            'email' => 'vetrinary@email.com',
            'password' => Hash::make('vetrinarypass'),
            'role' => 'vetrinary',
        ]);
    }
}
