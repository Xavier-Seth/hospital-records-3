<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * 
     * Run the database seeds.
     * 
     */

      // Clear users table
    

    public function run(): void
{

    User::query()->delete();

    User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
        'role' => 'admin',
    ]);

    User::create([
        'name' => 'Doctor User',
        'email' => 'doctor@example.com',
        'password' => Hash::make('password'),
        'role' => 'doctor',
    ]);

    User::create([
        'name' => 'Patient User',
        'email' => 'patient@example.com',
        'password' => Hash::make('password'),
        'role' => 'patient',
    ]);
  }
} 
