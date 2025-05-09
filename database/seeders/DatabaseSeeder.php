<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call custom UserSeeder to add admin, doctor, and patient
        $this->call([
            UserSeeder::class,
        ]);
    }
}
