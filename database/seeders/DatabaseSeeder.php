<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'User',
            'email' => 'admin@app.com',
            'password' => bcrypt('12345678'),
            'safe_value' => 0
        ]);
        Employee::factory()->count(20)->create();

    }
}
