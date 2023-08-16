<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = \App\Models\User::create([
            'name' => 'User',
            'email' => 'admin@app.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->save();
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            RoleUserTableSeeder::class,
//            UsersTableSeeder::class,

        ]);
        Company::factory(50)->create();

        Employee::factory()->count(20)->create();


    }
}
