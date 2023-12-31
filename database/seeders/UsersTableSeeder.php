<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@app.com',
                'password'       => bcrypt('12345678'),
                'remember_token' => null,
                'phone'          => '',
            ],
        ];

        User::insert($users);
    }
}
