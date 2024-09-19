<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@assettguard',
            'password' => 'P_iUWx7FVb2a.W3',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'tara',
            'email' => 'taranggawana49@gmail.com',
            'password' => Hash::make('tara49'),
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Agus',
            'email' => 'agus@mail.com',
            'password' => Hash::make('agus1234'),
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Tipuk',
            'email' => 'tipuk@mail.com',
            'password' => Hash::make('tipuk12345'),
        ]);
    }
}
